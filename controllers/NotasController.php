<?php

namespace app\controllers;

use app\models\Aluno;
use app\models\NotasDisciplina;
use app\models\Resposta;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * AlternativaController implements the CRUD actions for Alternativa model.
 */
class NotasController extends Controller
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

    public function actionNormalizacao()
    {
        $year = date('Y');
        $semestre = ((date('m') <= 7) ? 1 : 2);
        $alunos = Aluno::find()->orderBy(['matricula' => SORT_ASC, 'primeiro_nome' => SORT_ASC])->all();

        $acertosAluno = [];
        foreach ($alunos as $aluno) {
            $inicio_matricula = substr($aluno->matricula, 0, 4);
            if (empty($acertosAluno[$inicio_matricula])) {
                $acertosAluno[$inicio_matricula] = [];
            }
            array_push($acertosAluno[$inicio_matricula], ['acertos' => $aluno->getAcertosAdd(), 'aluno' => $aluno->id]);
        }

        $max = [];
        foreach ($acertosAluno as $matricula => $acertos) {
            $max[$matricula] = ['acertos' => 0, 'aluno' => null];
            foreach ($acertos as $acerto) {
                if ($acerto['acertos'] > $max[$matricula]['acertos']) {
                    $max[$matricula] = $acerto;
                }
            }
        }

        $notas = [];
        foreach ($alunos as $aluno) {
            $inicio_matricula = substr($aluno->matricula, 0, 4);
            if (empty($acertosAluno[$inicio_matricula])) {
                $acertosAluno[$inicio_matricula] = [];
            }
            array_push($acertosAluno[$inicio_matricula], ['acertos' => $aluno->getAcertosAdd(), 'aluno' => $aluno->id]);
        }
        foreach ($alunos as $aluno) {
            $inicio_matricula = substr($aluno->matricula, 0, 4);
            $disciplina_escolhida = NotasDisciplina::find()->where(['id_aluno'=>$aluno->id])->one();
            if ($max[$inicio_matricula]['acertos'] != 0)
                $nota = (($aluno->getAcertosAdd()) / $max[$inicio_matricula]['acertos']) * 0.5;
            else
                $nota = 0;
            array_push($notas, [
                'acertos' => $aluno->getAcertosAdd(),
                'matricula' => $aluno->matricula,
                'nome' => $aluno->primeiro_nome . ' ' . $aluno->ultimo_nome,
                'nota' => $nota,
                'disciplina_escolhida'=>(($disciplina_escolhida)?$disciplina_escolhida->disciplina->nome:''),
            ]);
        }
        $provider = new ArrayDataProvider([
            'allModels' => $notas,
            'sort' => [
                'attributes' => ['matricula', 'nome', 'acertos', 'nota', 'disciplina_escolhida'],
            ],
        ]);
        $provider->pagination = false;
        return $this->render('normalizacao', [
            'provider' => $provider,
        ]);
    }
}