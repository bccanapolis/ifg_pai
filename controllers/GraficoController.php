<?php

namespace app\controllers;

use app\models\Avaliacao;
use app\models\AvaliacaoCoordenador;
use app\models\Coordenacao;
use app\models\Disciplina;
use app\models\DisciplinaMatriz;
use app\models\PerguntaAvaliacaoCoordenador;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * DisciplinaController implements the CRUD actions for Disciplina model.
 */
class GraficoController extends Controller
{


    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'ghost-access' => [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Disciplina models.
     * @return mixed
     */
    public function actionIndex()
    {
        $connection = Yii::$app->db;
        $res = $connection->createCommand('select * from aluno;')->queryAll();
        return $this->render('index', [
            'dataProvider' => $res
        ]);

    }

    public function actionProfessor($professor = null, $disciplina = null)
    {
        $user = \app\models\User::find()->where(['id' => Yii::$app->user->id])->one();

        $connection = Yii::$app->db;
        if (is_null($professor)) {
            $res = null;
//            if (isset($user) && $user->professor) {
//                $res = $connection->createCommand('select distinct (professor.primeiro_nome || \' \' || professor.ultimo_nome) as nome, professor.id from avaliacao left join disciplina on avaliacao.id_disciplina = disciplina.id left join professor on disciplina.id_professor = professor.id where professor.user_id = :user_id', [':user_id' => $user->id])->queryAll();
//            } else {
            $res = $connection->createCommand("select distinct (professor.primeiro_nome || ' ' ||
                 case when professor.ultimo_nome > '' then professor.ultimo_nome else '' end) as nome,
                professor.id
from qac_professor
         left join turma on qac_professor.turma_id = turma.id
         left join disciplina on turma.disciplina_id = disciplina.id
         left join professor on turma.professor_id = professor.id")->queryAll();
//            }

            return $this->render('professor', [
                'dataProvider' => $res
            ]);
        }
    }

    public function actionApiProfessor(int $professor = null, int $disciplina = null, int $pergunta = null)
    {
        $connection = Yii::$app->db;
        $arr = [];
        $sql = "select count(nota),
       (case
            when nota = 0 then 'Péssimo'
            when nota = 1 then 'Ruim'
            when nota = 2 then 'Regular'
            when nota = 3 then 'Bom'
            when nota = 4 then 'Ótimo' end) as nota,
       nota                                 as ponto,
       (turma.ano || '-' || turma.semestre) as ano_semestre
from qac_professor
         left join turma on qac_professor.turma_id = turma.id

         left join disciplina on turma.disciplina_id = disciplina.id
         left join professor on turma.professor_id = professor.id
         left join qac_professor_pergunta on qac_professor.pergunta_id = qac_professor_pergunta.id";

        if (!is_null($professor)) {
            $sql .= ' where professor.id = :professor';
            $arr[':professor'] = $professor;
        }
        if (!is_null($disciplina)) {
            $sql .= ' and disciplina.id = :disciplina';
            $arr[':disciplina'] = $disciplina;
        }
        if (!is_null($pergunta)) {
            $sql .= ' and qac_professor_pergunta.id  = :pergunta';
            $arr[':pergunta'] = $pergunta;
        }
        $sql .= ' group by nota, ano_semestre order by ponto desc;';
        $res = $connection->createCommand($sql)->bindValues($arr)->queryAll();
        $label = [];
        foreach ($res as $voto) {
            if (!in_array($voto['ano_semestre'], $label)) {
                array_push($label, $voto['ano_semestre']);
            }
        }
        $title = '';

        if (is_null($disciplina)) {
            $title = "TODOS";
        } else {
            $title = Disciplina::findOne(['id' => $disciplina])->nome;
        }

        $matriculados = $this->alunosResponderamAvaliacaoProfessor($professor, $disciplina);

        $obj_matriculados = [];
        foreach ($matriculados as $matriculado) {
            $obj_matriculados[$matriculado['ano_semestre']] = $matriculado;
        }

        $data_json = ['series' => $res, 'label' => $label, 'title' => $title, 'matriculated' => $obj_matriculados];

        return JSON::encode($data_json);
    }

    private function alunosResponderamAvaliacaoProfessor(int $professor = null, int $disciplina = null)
    {
        $connection = Yii::$app->db;
        $arr = [];
        $sql = "select count(distinct qac_professor.aluno_id)             as alunos_responderam,
       (turma.ano || '-' || turma.semestre) as ano_semestre
from qac_professor
    left join turma on qac_professor.turma_id = turma.id
         left join disciplina on turma.disciplina_id = disciplina.id
         left join professor on turma.professor_id = professor.id";

        if (!is_null($professor)) {
            $sql .= ' where professor.id = :professor';
            $arr[':professor'] = $professor;
        }
        if (!is_null($disciplina)) {
            $sql .= ' and disciplina.id = :disciplina';
            $arr[':disciplina'] = $disciplina;
        }

        $sql .= ' group by ano_semestre;';
        $res = $connection->createCommand($sql)->bindValues($arr)->queryAll();
        return $res;
    }

    public function actionCoordenador()
    {
        $res = PerguntaAvaliacaoCoordenador::find()->all();
        return $this->render('coordenador', [
            'dataProvider' => $res
        ]);
    }

    public function actionAdd()
    {
        return $this->render('add');
    }

    public function actionApiAdd()
    {
        $connection = Yii::$app->db;
        $right = $connection->createCommand('select count(resposta.id),
       ((date_part(\'year\', now()) + 1 - cast(substring(aluno.matricula, 1, 4) as int)) *
        (date_part(\'quarter\', now()) / 2)) as periodo
from resposta
         left join alternativa on resposta.id_alternativa = alternativa.id
         left join aluno on resposta.id_aluno = aluno.id
where alternativa.correta = true
group by periodo;')->queryAll();

        $total = $connection->createCommand('select count(resposta.id),
       ((date_part(\'year\', now()) + 1 - cast(substring(aluno.matricula, 1, 4) as int)) *
        (date_part(\'quarter\', now()) / 2)) as periodo
from resposta
         left join aluno on resposta.id_aluno = aluno.id
group by periodo;')->queryAll();

        $data = [];
        $label = [];

        foreach ($right as $r) {
            foreach ($total as $t) {
                if ($r['periodo'] == $t['periodo']) {
                    array_push($data, array('count' => round($r['count'] * 100 / $t['count'], 1), 'periodo' => $r['periodo'], 'ano_semestre' => '2019-2'));
                }
            }
        }

        $data_json = ['series' => $data, 'label' => ['2019-2']];
        return JSON::encode($data_json);

    }

    public function actionApiCoordenador($curso = null, $pergunta = null)
    {
        $connection = Yii::$app->db;

        $user = Yii::$app->user;

        if (isset($user->professor)) {
            $curso = Coordenacao::find()->where(['professor_id' => Yii::$app->user->professor->id])->one()->curso_id;
        } else if (isset($user->aluno)) {
            $curso = $user->aluno->curso_id;
        }

        $res = null;
        if (!is_null($curso) && is_null($pergunta)) {
            $res = $connection->createCommand("select count(nota),
       (case
            when nota = 0 then 'Péssimo'
            when nota = 1 then 'Ruim'
            when nota = 2 then 'Regular'
            when nota = 3 then 'Bom'
            when nota = 4 then 'Ótimo' end) as nota,
       (ano || '-' || semestre)             as ano_semestre
from qac_coordenador
join coordenacao on coordenacao.id = qac_coordenador.coordenacao_id
where coordenacao.curso_id = :curso
group by nota, ano_semestre;", [':curso' => $curso])->queryAll();

        } else if (!is_null($curso) && !is_null($pergunta)) {
            $res = $connection->createCommand("select count(nota),
       (case
            when nota = 0 then 'Péssimo'
            when nota = 1 then 'Ruim'
            when nota = 2 then 'Regular'
            when nota = 3 then 'Bom'
            when nota = 4 then 'Ótimo' end) as nota,
       (ano || '-' || semestre)             as ano_semestre
from qac_coordenador
         join coordenacao on coordenacao.id = qac_coordenador.coordenacao_id
         left join qac_coordenador_pergunta qap on qac_coordenador.pergunta_id = qap.id
where qap.id = :pergunta
  and coordenacao.curso_id = :curso
group by nota, ano_semestre;", [':pergunta' => $pergunta, ':curso' => $curso])->queryAll();
        }

        $label = [];
        foreach ($res as $voto) {
            if (!in_array($voto['ano_semestre'], $label)) {
                array_push($label, $voto['ano_semestre']);
            }
        }

        $matriculados = $this->alunosResponderamAvaliacaoCoordenador($curso);

        $obj_matriculados = [];
        foreach ($matriculados as $matriculado) {
            $obj_matriculados[$matriculado['ano_semestre']] = $matriculado;
        }

        $data_json = ['series' => $res, 'labels' => $label, 'matriculated' => $obj_matriculados];
        return JSON::encode($data_json);

    }

    private function alunosResponderamAvaliacaoCoordenador($curso)
    {
        $connection = Yii::$app->db;
        $arr = [':curso' => $curso];
        $sql = "select count(distinct qac_coordenador.aluno_id) as alunos_responderam,
       (ano || '-' || semestre)                 as ano_semestre
from qac_coordenador
         join coordenacao on coordenacao.id = qac_coordenador.coordenacao_id
where coordenacao.curso_id = :curso
group by ano_semestre;";
        $res = $connection->createCommand($sql)->bindValues($arr)->queryAll();
        return $res;
    }

    public function actionDisciplina($professor = null)
    {
        $connection = Yii::$app->db;
        if (!is_null($professor)) {
            $res = $connection->createCommand('select distinct disciplina.id, disciplina.nome
from qac_professor
    left join turma on qac_professor.turma_id = turma.id
         left join disciplina on turma.disciplina_id = disciplina.id
where turma.professor_id = :id_professor', [':id_professor' => $professor])->queryAll();
            $data_json = ['disciplinas' => $res];
            return JSON::encode($data_json);
        }
    }


    public function actionPergunta()
    {
        $connection = Yii::$app->db;
        $res = $connection->createCommand('select id, enunciado from qac_professor_pergunta')->queryAll();
        $data_json = ['perguntas' => $res];
        return JSON::encode($data_json);
    }

}
