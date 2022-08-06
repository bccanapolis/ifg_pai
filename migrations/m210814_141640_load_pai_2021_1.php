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
                    'auth_key' => md5(microtime() . $password),
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
            chr(195) . chr(128) => 'A', chr(195) . chr(129) => 'A',
            chr(195) . chr(130) => 'A', chr(195) . chr(131) => 'A',
            chr(195) . chr(132) => 'A', chr(195) . chr(133) => 'A',
            chr(195) . chr(135) => 'C', chr(195) . chr(136) => 'E',
            chr(195) . chr(137) => 'E', chr(195) . chr(138) => 'E',
            chr(195) . chr(139) => 'E', chr(195) . chr(140) => 'I',
            chr(195) . chr(141) => 'I', chr(195) . chr(142) => 'I',
            chr(195) . chr(143) => 'I', chr(195) . chr(145) => 'N',
            chr(195) . chr(146) => 'O', chr(195) . chr(147) => 'O',
            chr(195) . chr(148) => 'O', chr(195) . chr(149) => 'O',
            chr(195) . chr(150) => 'O', chr(195) . chr(153) => 'U',
            chr(195) . chr(154) => 'U', chr(195) . chr(155) => 'U',
            chr(195) . chr(156) => 'U', chr(195) . chr(157) => 'Y',
            chr(195) . chr(159) => 's', chr(195) . chr(160) => 'a',
            chr(195) . chr(161) => 'a', chr(195) . chr(162) => 'a',
            chr(195) . chr(163) => 'a', chr(195) . chr(164) => 'a',
            chr(195) . chr(165) => 'a', chr(195) . chr(167) => 'c',
            chr(195) . chr(168) => 'e', chr(195) . chr(169) => 'e',
            chr(195) . chr(170) => 'e', chr(195) . chr(171) => 'e',
            chr(195) . chr(172) => 'i', chr(195) . chr(173) => 'i',
            chr(195) . chr(174) => 'i', chr(195) . chr(175) => 'i',
            chr(195) . chr(177) => 'n', chr(195) . chr(178) => 'o',
            chr(195) . chr(179) => 'o', chr(195) . chr(180) => 'o',
            chr(195) . chr(181) => 'o', chr(195) . chr(182) => 'o',
            chr(195) . chr(182) => 'o', chr(195) . chr(185) => 'u',
            chr(195) . chr(186) => 'u', chr(195) . chr(187) => 'u',
            chr(195) . chr(188) => 'u', chr(195) . chr(189) => 'y',
            chr(195) . chr(191) => 'y',
            // Decompositions for Latin Extended-A
            chr(196) . chr(128) => 'A', chr(196) . chr(129) => 'a',
            chr(196) . chr(130) => 'A', chr(196) . chr(131) => 'a',
            chr(196) . chr(132) => 'A', chr(196) . chr(133) => 'a',
            chr(196) . chr(134) => 'C', chr(196) . chr(135) => 'c',
            chr(196) . chr(136) => 'C', chr(196) . chr(137) => 'c',
            chr(196) . chr(138) => 'C', chr(196) . chr(139) => 'c',
            chr(196) . chr(140) => 'C', chr(196) . chr(141) => 'c',
            chr(196) . chr(142) => 'D', chr(196) . chr(143) => 'd',
            chr(196) . chr(144) => 'D', chr(196) . chr(145) => 'd',
            chr(196) . chr(146) => 'E', chr(196) . chr(147) => 'e',
            chr(196) . chr(148) => 'E', chr(196) . chr(149) => 'e',
            chr(196) . chr(150) => 'E', chr(196) . chr(151) => 'e',
            chr(196) . chr(152) => 'E', chr(196) . chr(153) => 'e',
            chr(196) . chr(154) => 'E', chr(196) . chr(155) => 'e',
            chr(196) . chr(156) => 'G', chr(196) . chr(157) => 'g',
            chr(196) . chr(158) => 'G', chr(196) . chr(159) => 'g',
            chr(196) . chr(160) => 'G', chr(196) . chr(161) => 'g',
            chr(196) . chr(162) => 'G', chr(196) . chr(163) => 'g',
            chr(196) . chr(164) => 'H', chr(196) . chr(165) => 'h',
            chr(196) . chr(166) => 'H', chr(196) . chr(167) => 'h',
            chr(196) . chr(168) => 'I', chr(196) . chr(169) => 'i',
            chr(196) . chr(170) => 'I', chr(196) . chr(171) => 'i',
            chr(196) . chr(172) => 'I', chr(196) . chr(173) => 'i',
            chr(196) . chr(174) => 'I', chr(196) . chr(175) => 'i',
            chr(196) . chr(176) => 'I', chr(196) . chr(177) => 'i',
            chr(196) . chr(178) => 'IJ', chr(196) . chr(179) => 'ij',
            chr(196) . chr(180) => 'J', chr(196) . chr(181) => 'j',
            chr(196) . chr(182) => 'K', chr(196) . chr(183) => 'k',
            chr(196) . chr(184) => 'k', chr(196) . chr(185) => 'L',
            chr(196) . chr(186) => 'l', chr(196) . chr(187) => 'L',
            chr(196) . chr(188) => 'l', chr(196) . chr(189) => 'L',
            chr(196) . chr(190) => 'l', chr(196) . chr(191) => 'L',
            chr(197) . chr(128) => 'l', chr(197) . chr(129) => 'L',
            chr(197) . chr(130) => 'l', chr(197) . chr(131) => 'N',
            chr(197) . chr(132) => 'n', chr(197) . chr(133) => 'N',
            chr(197) . chr(134) => 'n', chr(197) . chr(135) => 'N',
            chr(197) . chr(136) => 'n', chr(197) . chr(137) => 'N',
            chr(197) . chr(138) => 'n', chr(197) . chr(139) => 'N',
            chr(197) . chr(140) => 'O', chr(197) . chr(141) => 'o',
            chr(197) . chr(142) => 'O', chr(197) . chr(143) => 'o',
            chr(197) . chr(144) => 'O', chr(197) . chr(145) => 'o',
            chr(197) . chr(146) => 'OE', chr(197) . chr(147) => 'oe',
            chr(197) . chr(148) => 'R', chr(197) . chr(149) => 'r',
            chr(197) . chr(150) => 'R', chr(197) . chr(151) => 'r',
            chr(197) . chr(152) => 'R', chr(197) . chr(153) => 'r',
            chr(197) . chr(154) => 'S', chr(197) . chr(155) => 's',
            chr(197) . chr(156) => 'S', chr(197) . chr(157) => 's',
            chr(197) . chr(158) => 'S', chr(197) . chr(159) => 's',
            chr(197) . chr(160) => 'S', chr(197) . chr(161) => 's',
            chr(197) . chr(162) => 'T', chr(197) . chr(163) => 't',
            chr(197) . chr(164) => 'T', chr(197) . chr(165) => 't',
            chr(197) . chr(166) => 'T', chr(197) . chr(167) => 't',
            chr(197) . chr(168) => 'U', chr(197) . chr(169) => 'u',
            chr(197) . chr(170) => 'U', chr(197) . chr(171) => 'u',
            chr(197) . chr(172) => 'U', chr(197) . chr(173) => 'u',
            chr(197) . chr(174) => 'U', chr(197) . chr(175) => 'u',
            chr(197) . chr(176) => 'U', chr(197) . chr(177) => 'u',
            chr(197) . chr(178) => 'U', chr(197) . chr(179) => 'u',
            chr(197) . chr(180) => 'W', chr(197) . chr(181) => 'w',
            chr(197) . chr(182) => 'Y', chr(197) . chr(183) => 'y',
            chr(197) . chr(184) => 'Y', chr(197) . chr(185) => 'Z',
            chr(197) . chr(186) => 'z', chr(197) . chr(187) => 'Z',
            chr(197) . chr(188) => 'z', chr(197) . chr(189) => 'Z',
            chr(197) . chr(190) => 'z', chr(197) . chr(191) => 's'
        );

        $string = strtr($string, $chars);

        return $string;
    }
}
