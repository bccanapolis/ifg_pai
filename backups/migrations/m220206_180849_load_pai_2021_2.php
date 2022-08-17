<?php

use app\models\Aluno;
use app\models\AlunoDisciplina;
use app\models\Disciplina;
use app\models\DisciplinaMatriz;
use webvimark\modules\UserManagement\models\User;
use app\models\Professor;
use yii\db\Migration;

/**
 * Class m220206_180849_load_pai_2021_2
 */
class m220206_180849_load_pai_2021_2 extends Migration
{
    private function checkProfessores($professoresSheet, $ano, $semestre)
    {
        $columns = [
            'disciplina' => 0,
            'nome' => 1,
            'siape' => 2,
        ];

        function getSiape($r)
        {
            return $r["siape"];
        }

        function getSiapeSheet($r)
        {
            return $r[2];
        }

        $professoresDB = Professor::find()->asArray()->all();
        $users = User::find()->asArray()->all();

        # pega apenas o campo siape
        $professoresSiapeDB = array_map("getSiape", $professoresDB);
        # pega quais siapes não estão no banco
        $professoresNotInDB = array_diff(array_unique(array_map("getSiapeSheet", $professoresSheet)), $professoresSiapeDB);

        $lastUserID = max(array_column($users, 'id'));
        $lastProfessorID = max(array_column($professoresDB, 'id'));
        $password = 'superadmin';

        print_r("Professores que não estão no banco de dados!");
        print_r($professoresNotInDB);
        print_r('------------\n');

        # adiciona os professores que não estão no banco
        foreach ($professoresNotInDB as $key => $value) {
            try {
                $professorIndexSheet = $professoresSheet[array_search($value, array_column($professoresSheet, $columns['siape']))];

                $timestamp = new DateTime();
                $timestamp = $timestamp->getTimestamp();
                $userID = $lastUserID + $key + 1;
                $professorID = $lastProfessorID + $key + 1;
                $this->insert('user', [
                    'id' => $userID,
                    'username' => $value,
                    'status' => User::STATUS_ACTIVE,
                    'auth_key' => md5(m220206_180849_load_pai_2021_2 . phpmicrotime()),
                    'password_hash' => md5($password),
                    'superadmin' => 0,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ]);

                $this->insert('{{%professor}}',
                    [
                        'id' => $professorID,
                        'primeiro_nome' => explode(' ', $professorIndexSheet[$columns['nome']])[0],
                        'siape' => $value,
                        'tipo' => Professor::$TIPO_PROFESSOR,
                        'user_id' => $userID
                    ]
                );

            } catch (\yii\db\Exception $exception) {
                print_r($exception);
            }
        }

        $disciplinas = Disciplina::find()->asArray()->all();
        $lastDisciplinaID = max(array_column($disciplinas, 'id'));

        # adiciona relação professor-disciplina do semestre
        foreach ($professoresSheet as $key => $value) {
            $nomeDisciplina = strtoupper($this->remove_accents(trim($value[$columns['disciplina']])));
            $siapeProfessor = $value[$columns['siape']];

            $professor = Professor::findOne(['siape' => $siapeProfessor]);
            print_r("Siape Professor: " . $siapeProfessor . "\n");
            print_r("Professor: " . $professor->primeiro_nome . "\n");

            $disciplinaMatriz = DisciplinaMatriz::findOne(['nome' => $nomeDisciplina]);
            print_r("Disciplina: " . $disciplinaMatriz->nome . "\n");

            $this->insert('disciplina',
                [
                    'id' => $lastDisciplinaID + $key + 1,
                    'nome' => $disciplinaMatriz->nome,
                    'ano' => $ano,
                    'semestre' => $semestre,
                    'id_professor' => $professor->id,
                    'id_disciplina_matriz' => $disciplinaMatriz->id
                ]
            );

            print_r("----------\n");
        }

    }

    private function checkAlunos($alunosSheet, $ano, $semestre)
    {
        $columns = [
            'matricula' => 0,
            'nome' => 1,
            'disciplina' => 2,
        ];

        function getMatricula($r)
        {
            return $r["matricula"];
        }

        function getMatriculaSheet($r)
        {
            return $r[0];
        }

        $alunosDB = Aluno::find()->asArray()->all();
        $alunosMatriculaDB = array_map("getMatricula", $alunosDB);


        $alunosNotInDB = array_diff(array_unique(array_map("getMatriculaSheet", $alunosSheet)), $alunosMatriculaDB);
        $lastAlunoID = max(array_column($alunosDB, 'id'));

        # adiciona os professores que não estão no banco
        foreach ($alunosNotInDB as $key => $value) {
            try {
                $alunoIndexSheet = $alunosSheet[array_search($value, array_column($alunosSheet, $columns['matricula']))];

                $alunoID = $lastAlunoID + $key + 1;

                $this->insert('aluno',
                    [
                        'id' => $alunoID,
                        'matricula' => $alunoIndexSheet[$columns['matricula']],
                    ]
                );
            } catch (\yii\db\Exception $exception) {
                print_r($exception);
            }
        }

        // cria um array de objeto por disciplina
        $disciplinasObject = array();
        foreach ($alunosSheet as $key => $value) {
            if (!array_key_exists($value[$columns['disciplina']], $disciplinasObject)) {
                $disciplinasObject[$value[$columns['disciplina']]] = array();
            }

            if (!in_array($value, $disciplinasObject[$value[$columns['disciplina']]])) {
                array_push($disciplinasObject[$value[$columns['disciplina']]], $value);
            }
        }

        $alunoDisciplinas = AlunoDisciplina::find()->asArray()->all();
        $lastAlunoDisciplinaID = max(array_column($alunoDisciplinas, 'id'));

        $indexAlunos = 1;

        foreach ($disciplinasObject as $keyDisc => $valueDisc) {
            $nomeDisciplina = strtoupper($this->remove_accents(trim($keyDisc)));
            $disciplina = Disciplina::findOne(['nome' => $nomeDisciplina, 'ano' => $ano, 'semestre' => $semestre]);

            foreach ($valueDisc as $key => $value) {
                $matriculaAluno = $value[0];
                $aluno = Aluno::findOne(['matricula' => $matriculaAluno]);

                print_r("Matricula Aluno: " . $matriculaAluno . "\n");
                print_r("Aluno: " . $aluno->primeiro_nome . "\n");
                print_r("Disciplina: " . $nomeDisciplina . "\n");
                print_r("Disciplina ID: " . $disciplina->id . "\n");

                $this->insert('aluno_disciplina',
                    [
                        'id' => $lastAlunoDisciplinaID + $indexAlunos + 1,
                        'id_aluno' => $aluno->id,
                        'id_disciplina' => $disciplina->id
                    ]
                );

                $indexAlunos = $indexAlunos + 1;
                print_r("----------\n");
            }
        }
    }

    public function safeUp()
    {
        $ano = 2021;
        $semestre = 2;

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("./scriptsql/PAI_2021_2.xlsx");

        $professoresSheet = $spreadsheet->getSheet(1)->toArray();
        $professoresSheetClean = [];
        foreach ($professoresSheet as $row) {
            if (!array_filter($row)) continue;
            array_push($professoresSheetClean, [$row[0], $row[1], $row[2]]);
        }
        $this->checkProfessores($professoresSheetClean, $ano, $semestre);

        $alunosSheet = $spreadsheet->getSheet(0)->toArray();
        $alunosSheetClean = [];
        foreach ($alunosSheet as $row) {
            if (!array_filter($row)) continue;
            array_push($alunosSheetClean, [$row[0], $row[1], $row[2]]);
        }
        $this->checkAlunos($alunosSheetClean, $ano, $semestre);
    }

    public function safeDown()
    {
        echo "m210813_141640_loadPai20211 cannot be reverted.\n";

        return false;
    }

    private function remove_accents($string)
    {
        if (!preg_match('/[\x80-\xff]/', $string))
            return $string;

        $chars = array(
            // Decompositions for Latin-1 Supplement
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'A', m220206_180849_load_pai_2021_2 . phpchr(195) => 'A',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'A', m220206_180849_load_pai_2021_2 . phpchr(195) => 'A',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'A', m220206_180849_load_pai_2021_2 . phpchr(195) => 'A',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'C', m220206_180849_load_pai_2021_2 . phpchr(195) => 'E',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'E', m220206_180849_load_pai_2021_2 . phpchr(195) => 'E',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'E', m220206_180849_load_pai_2021_2 . phpchr(195) => 'I',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'I', m220206_180849_load_pai_2021_2 . phpchr(195) => 'I',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'I', m220206_180849_load_pai_2021_2 . phpchr(195) => 'N',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'O', m220206_180849_load_pai_2021_2 . phpchr(195) => 'O',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'O', m220206_180849_load_pai_2021_2 . phpchr(195) => 'O',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'O', m220206_180849_load_pai_2021_2 . phpchr(195) => 'U',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'U', m220206_180849_load_pai_2021_2 . phpchr(195) => 'U',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'U', m220206_180849_load_pai_2021_2 . phpchr(195) => 'Y',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 's', m220206_180849_load_pai_2021_2 . phpchr(195) => 'a',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'a', m220206_180849_load_pai_2021_2 . phpchr(195) => 'a',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'a', m220206_180849_load_pai_2021_2 . phpchr(195) => 'a',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'a', m220206_180849_load_pai_2021_2 . phpchr(195) => 'c',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'e', m220206_180849_load_pai_2021_2 . phpchr(195) => 'e',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'e', m220206_180849_load_pai_2021_2 . phpchr(195) => 'e',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'i', m220206_180849_load_pai_2021_2 . phpchr(195) => 'i',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'i', m220206_180849_load_pai_2021_2 . phpchr(195) => 'i',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'n', m220206_180849_load_pai_2021_2 . phpchr(195) => 'o',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'o', m220206_180849_load_pai_2021_2 . phpchr(195) => 'o',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'o', m220206_180849_load_pai_2021_2 . phpchr(195) => 'o',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'o', m220206_180849_load_pai_2021_2 . phpchr(195) => 'u',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'u', m220206_180849_load_pai_2021_2 . phpchr(195) => 'u',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'u', m220206_180849_load_pai_2021_2 . phpchr(195) => 'y',
            m220206_180849_load_pai_2021_2 . phpchr(195) => 'y',
            // Decompositions for Latin Extended-A
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'A', m220206_180849_load_pai_2021_2 . phpchr(196) => 'a',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'A', m220206_180849_load_pai_2021_2 . phpchr(196) => 'a',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'A', m220206_180849_load_pai_2021_2 . phpchr(196) => 'a',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'C', m220206_180849_load_pai_2021_2 . phpchr(196) => 'c',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'C', m220206_180849_load_pai_2021_2 . phpchr(196) => 'c',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'C', m220206_180849_load_pai_2021_2 . phpchr(196) => 'c',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'C', m220206_180849_load_pai_2021_2 . phpchr(196) => 'c',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'D', m220206_180849_load_pai_2021_2 . phpchr(196) => 'd',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'D', m220206_180849_load_pai_2021_2 . phpchr(196) => 'd',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'E', m220206_180849_load_pai_2021_2 . phpchr(196) => 'e',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'E', m220206_180849_load_pai_2021_2 . phpchr(196) => 'e',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'E', m220206_180849_load_pai_2021_2 . phpchr(196) => 'e',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'E', m220206_180849_load_pai_2021_2 . phpchr(196) => 'e',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'E', m220206_180849_load_pai_2021_2 . phpchr(196) => 'e',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'G', m220206_180849_load_pai_2021_2 . phpchr(196) => 'g',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'G', m220206_180849_load_pai_2021_2 . phpchr(196) => 'g',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'G', m220206_180849_load_pai_2021_2 . phpchr(196) => 'g',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'G', m220206_180849_load_pai_2021_2 . phpchr(196) => 'g',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'H', m220206_180849_load_pai_2021_2 . phpchr(196) => 'h',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'H', m220206_180849_load_pai_2021_2 . phpchr(196) => 'h',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'I', m220206_180849_load_pai_2021_2 . phpchr(196) => 'i',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'I', m220206_180849_load_pai_2021_2 . phpchr(196) => 'i',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'I', m220206_180849_load_pai_2021_2 . phpchr(196) => 'i',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'I', m220206_180849_load_pai_2021_2 . phpchr(196) => 'i',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'I', m220206_180849_load_pai_2021_2 . phpchr(196) => 'i',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'IJ', m220206_180849_load_pai_2021_2 . phpchr(196) => 'ij',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'J', m220206_180849_load_pai_2021_2 . phpchr(196) => 'j',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'K', m220206_180849_load_pai_2021_2 . phpchr(196) => 'k',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'k', m220206_180849_load_pai_2021_2 . phpchr(196) => 'L',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'l', m220206_180849_load_pai_2021_2 . phpchr(196) => 'L',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'l', m220206_180849_load_pai_2021_2 . phpchr(196) => 'L',
            m220206_180849_load_pai_2021_2 . phpchr(196) => 'l', m220206_180849_load_pai_2021_2 . phpchr(196) => 'L',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'l', m220206_180849_load_pai_2021_2 . phpchr(197) => 'L',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'l', m220206_180849_load_pai_2021_2 . phpchr(197) => 'N',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'n', m220206_180849_load_pai_2021_2 . phpchr(197) => 'N',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'n', m220206_180849_load_pai_2021_2 . phpchr(197) => 'N',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'n', m220206_180849_load_pai_2021_2 . phpchr(197) => 'N',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'n', m220206_180849_load_pai_2021_2 . phpchr(197) => 'N',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'O', m220206_180849_load_pai_2021_2 . phpchr(197) => 'o',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'O', m220206_180849_load_pai_2021_2 . phpchr(197) => 'o',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'O', m220206_180849_load_pai_2021_2 . phpchr(197) => 'o',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'OE', m220206_180849_load_pai_2021_2 . phpchr(197) => 'oe',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'R', m220206_180849_load_pai_2021_2 . phpchr(197) => 'r',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'R', m220206_180849_load_pai_2021_2 . phpchr(197) => 'r',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'R', m220206_180849_load_pai_2021_2 . phpchr(197) => 'r',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'S', m220206_180849_load_pai_2021_2 . phpchr(197) => 's',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'S', m220206_180849_load_pai_2021_2 . phpchr(197) => 's',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'S', m220206_180849_load_pai_2021_2 . phpchr(197) => 's',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'S', m220206_180849_load_pai_2021_2 . phpchr(197) => 's',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'T', m220206_180849_load_pai_2021_2 . phpchr(197) => 't',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'T', m220206_180849_load_pai_2021_2 . phpchr(197) => 't',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'T', m220206_180849_load_pai_2021_2 . phpchr(197) => 't',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'U', m220206_180849_load_pai_2021_2 . phpchr(197) => 'u',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'U', m220206_180849_load_pai_2021_2 . phpchr(197) => 'u',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'U', m220206_180849_load_pai_2021_2 . phpchr(197) => 'u',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'U', m220206_180849_load_pai_2021_2 . phpchr(197) => 'u',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'U', m220206_180849_load_pai_2021_2 . phpchr(197) => 'u',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'U', m220206_180849_load_pai_2021_2 . phpchr(197) => 'u',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'W', m220206_180849_load_pai_2021_2 . phpchr(197) => 'w',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'Y', m220206_180849_load_pai_2021_2 . phpchr(197) => 'y',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'Y', m220206_180849_load_pai_2021_2 . phpchr(197) => 'Z',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'z', m220206_180849_load_pai_2021_2 . phpchr(197) => 'Z',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'z', m220206_180849_load_pai_2021_2 . phpchr(197) => 'Z',
            m220206_180849_load_pai_2021_2 . phpchr(197) => 'z', m220206_180849_load_pai_2021_2 . phpchr(197) => 's'
        );

        $string = strtr($string, $chars);

        return $string;
    }
}
