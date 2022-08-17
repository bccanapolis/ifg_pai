<?php

use app\models\Aluno;
use app\models\AlunoDisciplina;
use app\models\Disciplina;
use app\models\DisciplinaMatriz;
use webvimark\modules\UserManagement\models\User;
use app\models\Professor;
use yii\db\Migration;

/**
 * Class m210813_141640_loadPai20211
 */
class m210814_141640_load_pai_2021_1 extends Migration
{

    private function checkProfessores($professoresSheet, $ano, $semestre)
    {

        function getSiape($r)
        {
            return $r["siape"];
        }

        function getSiapeSheet($r)
        {
            return $r[3];
        }

        $professoresDB = Professor::find()->asArray()->all();
        $users = User::find()->asArray()->all();

        # pega apenas o campo siape
        $professoresSiapeDB = array_map("getSiape", $professoresDB);
        # pega quais siapes não estão no banco
        $professoresNotInDB = array_diff(array_unique(array_map("getSiapeSheet", $professoresSheet)), $professoresSiapeDB);

        $lastProfessorID = max(array_column($users, 'id'));
        $lastUserID = max(array_column($professoresDB, 'id'));
        $password = 'superadmin';

        # adiciona os professores que não estão no banco
        foreach ($professoresNotInDB as $key => $value) {
            try {
                $professorIndexSheet = $professoresSheet[array_search($value, array_column($professoresSheet, 3))];

                $timestamp = new DateTime();
                $timestamp = $timestamp->getTimestamp();
                $userID = $lastUserID + $key + 1;
                $professorID = $lastProfessorID + $key + 1;

                $this->insert('user', [
                    'id' => $userID,
                    'username' => $value,
                    'status' => User::STATUS_ACTIVE,
                    'auth_key' => md5(m210814_141640_load_pai_2021_1 . phpmicrotime()),
                    'password_hash' => md5($password),
                    'superadmin' => 0,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ]);

                $this->insert('{{%professor}}',
                    [
                        'id' => $professorID,
                        'primeiro_nome' => $professorIndexSheet[2],
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
            $nomeDisciplina = strtoupper($this->remove_accents(trim($value[1])));
            $siapeProfessor = $value[3];

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
                $alunoIndexSheet = $alunosSheet[array_search($value, array_column($alunosSheet, 0))];

                $alunoID = $lastAlunoID + $key + 1;

                $this->insert('aluno',
                    [
                        'id' => $alunoID,
                        'matricula' => $alunoIndexSheet[0],
                    ]
                );
            } catch (\yii\db\Exception $exception) {
                print_r($exception);
            }
        }

        // cria um array de objeto por disciplina
        $disciplinasObject = array();
        foreach ($alunosSheet as $key => $value) {
            if (!array_key_exists($value[4], $disciplinasObject)) {
                $disciplinasObject[$value[4]] = array();
            }

            if(!in_array($value, $disciplinasObject[$value[4]])){
                array_push($disciplinasObject[$value[4]], $value);
            }
        }

        $alunoDisciplinas = AlunoDisciplina::find()->asArray()->all();
        $lastAlunoDisciplinaID = max(array_column($alunoDisciplinas, 'id'));

        print_r("--------\n".$lastAlunoDisciplinaID."\n-----------\n");

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
                print_r("Disciplina: " . $disciplina->nome . "\n");


                $this->insert('aluno_disciplina',
                    [
                        'id'=> $lastAlunoDisciplinaID + $indexAlunos + 1,
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
        $semestre = 1;

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("./scriptsql/PAI_2021_1.xlsx");

        $professoresSheet = $spreadsheet->getSheet(1)->toArray();
        $this->checkProfessores($professoresSheet, $ano, $semestre);

        $alunosSheet = $spreadsheet->getSheet(0)->toArray();
        $this->checkAlunos($alunosSheet, $ano, $semestre);
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
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'A', m210814_141640_load_pai_2021_1 . phpchr(195) => 'A',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'A', m210814_141640_load_pai_2021_1 . phpchr(195) => 'A',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'A', m210814_141640_load_pai_2021_1 . phpchr(195) => 'A',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'C', m210814_141640_load_pai_2021_1 . phpchr(195) => 'E',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'E', m210814_141640_load_pai_2021_1 . phpchr(195) => 'E',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'E', m210814_141640_load_pai_2021_1 . phpchr(195) => 'I',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'I', m210814_141640_load_pai_2021_1 . phpchr(195) => 'I',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'I', m210814_141640_load_pai_2021_1 . phpchr(195) => 'N',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'O', m210814_141640_load_pai_2021_1 . phpchr(195) => 'O',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'O', m210814_141640_load_pai_2021_1 . phpchr(195) => 'O',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'O', m210814_141640_load_pai_2021_1 . phpchr(195) => 'U',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'U', m210814_141640_load_pai_2021_1 . phpchr(195) => 'U',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'U', m210814_141640_load_pai_2021_1 . phpchr(195) => 'Y',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 's', m210814_141640_load_pai_2021_1 . phpchr(195) => 'a',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'a', m210814_141640_load_pai_2021_1 . phpchr(195) => 'a',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'a', m210814_141640_load_pai_2021_1 . phpchr(195) => 'a',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'a', m210814_141640_load_pai_2021_1 . phpchr(195) => 'c',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'e', m210814_141640_load_pai_2021_1 . phpchr(195) => 'e',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'e', m210814_141640_load_pai_2021_1 . phpchr(195) => 'e',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'i', m210814_141640_load_pai_2021_1 . phpchr(195) => 'i',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'i', m210814_141640_load_pai_2021_1 . phpchr(195) => 'i',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'n', m210814_141640_load_pai_2021_1 . phpchr(195) => 'o',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'o', m210814_141640_load_pai_2021_1 . phpchr(195) => 'o',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'o', m210814_141640_load_pai_2021_1 . phpchr(195) => 'o',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'o', m210814_141640_load_pai_2021_1 . phpchr(195) => 'u',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'u', m210814_141640_load_pai_2021_1 . phpchr(195) => 'u',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'u', m210814_141640_load_pai_2021_1 . phpchr(195) => 'y',
            m210814_141640_load_pai_2021_1 . phpchr(195) => 'y',
            // Decompositions for Latin Extended-A
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'A', m210814_141640_load_pai_2021_1 . phpchr(196) => 'a',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'A', m210814_141640_load_pai_2021_1 . phpchr(196) => 'a',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'A', m210814_141640_load_pai_2021_1 . phpchr(196) => 'a',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'C', m210814_141640_load_pai_2021_1 . phpchr(196) => 'c',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'C', m210814_141640_load_pai_2021_1 . phpchr(196) => 'c',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'C', m210814_141640_load_pai_2021_1 . phpchr(196) => 'c',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'C', m210814_141640_load_pai_2021_1 . phpchr(196) => 'c',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'D', m210814_141640_load_pai_2021_1 . phpchr(196) => 'd',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'D', m210814_141640_load_pai_2021_1 . phpchr(196) => 'd',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'E', m210814_141640_load_pai_2021_1 . phpchr(196) => 'e',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'E', m210814_141640_load_pai_2021_1 . phpchr(196) => 'e',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'E', m210814_141640_load_pai_2021_1 . phpchr(196) => 'e',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'E', m210814_141640_load_pai_2021_1 . phpchr(196) => 'e',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'E', m210814_141640_load_pai_2021_1 . phpchr(196) => 'e',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'G', m210814_141640_load_pai_2021_1 . phpchr(196) => 'g',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'G', m210814_141640_load_pai_2021_1 . phpchr(196) => 'g',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'G', m210814_141640_load_pai_2021_1 . phpchr(196) => 'g',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'G', m210814_141640_load_pai_2021_1 . phpchr(196) => 'g',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'H', m210814_141640_load_pai_2021_1 . phpchr(196) => 'h',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'H', m210814_141640_load_pai_2021_1 . phpchr(196) => 'h',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'I', m210814_141640_load_pai_2021_1 . phpchr(196) => 'i',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'I', m210814_141640_load_pai_2021_1 . phpchr(196) => 'i',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'I', m210814_141640_load_pai_2021_1 . phpchr(196) => 'i',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'I', m210814_141640_load_pai_2021_1 . phpchr(196) => 'i',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'I', m210814_141640_load_pai_2021_1 . phpchr(196) => 'i',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'IJ', m210814_141640_load_pai_2021_1 . phpchr(196) => 'ij',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'J', m210814_141640_load_pai_2021_1 . phpchr(196) => 'j',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'K', m210814_141640_load_pai_2021_1 . phpchr(196) => 'k',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'k', m210814_141640_load_pai_2021_1 . phpchr(196) => 'L',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'l', m210814_141640_load_pai_2021_1 . phpchr(196) => 'L',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'l', m210814_141640_load_pai_2021_1 . phpchr(196) => 'L',
            m210814_141640_load_pai_2021_1 . phpchr(196) => 'l', m210814_141640_load_pai_2021_1 . phpchr(196) => 'L',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'l', m210814_141640_load_pai_2021_1 . phpchr(197) => 'L',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'l', m210814_141640_load_pai_2021_1 . phpchr(197) => 'N',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'n', m210814_141640_load_pai_2021_1 . phpchr(197) => 'N',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'n', m210814_141640_load_pai_2021_1 . phpchr(197) => 'N',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'n', m210814_141640_load_pai_2021_1 . phpchr(197) => 'N',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'n', m210814_141640_load_pai_2021_1 . phpchr(197) => 'N',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'O', m210814_141640_load_pai_2021_1 . phpchr(197) => 'o',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'O', m210814_141640_load_pai_2021_1 . phpchr(197) => 'o',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'O', m210814_141640_load_pai_2021_1 . phpchr(197) => 'o',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'OE', m210814_141640_load_pai_2021_1 . phpchr(197) => 'oe',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'R', m210814_141640_load_pai_2021_1 . phpchr(197) => 'r',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'R', m210814_141640_load_pai_2021_1 . phpchr(197) => 'r',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'R', m210814_141640_load_pai_2021_1 . phpchr(197) => 'r',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'S', m210814_141640_load_pai_2021_1 . phpchr(197) => 's',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'S', m210814_141640_load_pai_2021_1 . phpchr(197) => 's',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'S', m210814_141640_load_pai_2021_1 . phpchr(197) => 's',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'S', m210814_141640_load_pai_2021_1 . phpchr(197) => 's',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'T', m210814_141640_load_pai_2021_1 . phpchr(197) => 't',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'T', m210814_141640_load_pai_2021_1 . phpchr(197) => 't',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'T', m210814_141640_load_pai_2021_1 . phpchr(197) => 't',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'U', m210814_141640_load_pai_2021_1 . phpchr(197) => 'u',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'U', m210814_141640_load_pai_2021_1 . phpchr(197) => 'u',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'U', m210814_141640_load_pai_2021_1 . phpchr(197) => 'u',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'U', m210814_141640_load_pai_2021_1 . phpchr(197) => 'u',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'U', m210814_141640_load_pai_2021_1 . phpchr(197) => 'u',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'U', m210814_141640_load_pai_2021_1 . phpchr(197) => 'u',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'W', m210814_141640_load_pai_2021_1 . phpchr(197) => 'w',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'Y', m210814_141640_load_pai_2021_1 . phpchr(197) => 'y',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'Y', m210814_141640_load_pai_2021_1 . phpchr(197) => 'Z',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'z', m210814_141640_load_pai_2021_1 . phpchr(197) => 'Z',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'z', m210814_141640_load_pai_2021_1 . phpchr(197) => 'Z',
            m210814_141640_load_pai_2021_1 . phpchr(197) => 'z', m210814_141640_load_pai_2021_1 . phpchr(197) => 's'
        );

        $string = strtr($string, $chars);

        return $string;
    }
}
