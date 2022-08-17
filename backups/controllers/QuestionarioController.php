<?php

namespace app\controllers;

use kartik\mpdf\Pdf;
//use Mpdf\Mpdf;
use app\models\Questao;
use app\models\Resposta;
use app\models\User;
use Yii;
use app\models\Alternativa;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * AlternativaController implements the CRUD actions for Alternativa model.
 */
class QuestionarioController extends Controller
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

    public function actionListarPerguntas($active = 0)
    {
        if (!isset(Yii::$app->params['questionarioLiberado']) or Yii::$app->params['questionarioLiberado'] == false){
            Yii::$app->session->addFlash('info', 'Questionário não está liberado!');
            return $this->redirect(['/site/index']);
        }

        $year = date('Y');
        $semestre = ((date('m') <= 7) ? 1 : 2);
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();

        $model = new Resposta();
        $perguntas = Questao::find()->orderBy(['id' => SORT_ASC])
            ->innerJoin('disciplina', 'disciplina.id = questao.id_disciplina')
            ->where(['disciplina.ano' => $year])
            ->andWhere(['disciplina.semestre' => $semestre])
            ->orderBy('id_disciplina')
            ->all();

        if (empty($perguntas)) {
            Yii::$app->session->addFlash('info', 'Não há questionários a ser respondidos...');
            return $this->redirect(['site/index']);
        }

        if ($user->aluno) {
            $model->id_aluno = $user->aluno->id;
        } else {
            Yii::$app->session->addFlash('error', 'Somente alunos podem responder ao Questionário!');
            return $this->redirect(['site/index']);
        }
        $respostaJaEnviada = Resposta::find()->where(['id_questao' => $perguntas[$active]->id, 'id_aluno' => $user->aluno->id])->one();
        if (!is_null($respostaJaEnviada)) {
            $model->id_alternativa = $respostaJaEnviada->id_alternativa;
        }

        $totalRespostasAluno = Resposta::find()->leftJoin('questao', 'resposta.id_questao = questao.id')
            ->leftJoin('disciplina', 'disciplina.id = questao.id_disciplina')
            ->leftJoin('alternativa', 'resposta.id_alternativa = alternativa.id')
            ->where(['resposta.id_aluno' => $user->aluno->id, 'disciplina.ano' => $year, 'disciplina.semestre' => $semestre])
            ->distinct('questao.id')->count();

        $totalQuestoes = count($perguntas);

        if ($totalRespostasAluno >= $totalQuestoes and ($active == $totalQuestoes - 1 || $active == 0)) {
            Yii::$app->session->addFlash('error', 'Você já respondeu este Questionário!');
            return $this->redirect(['site/index']);
        }

        $respostas = Resposta::find()->select('questao.id as id_questao_respondida')->leftJoin('questao', 'resposta.id_questao = questao.id')
            ->leftJoin('disciplina', 'disciplina.id = questao.id_disciplina')
            ->leftJoin('alternativa', 'resposta.id_alternativa = alternativa.id')
            ->where(['resposta.id_aluno' => $user->aluno->id, 'disciplina.ano' => $year, 'disciplina.semestre' => $semestre])
            ->distinct('questao.id')->asArray()->all();

        if ($model->load(Yii::$app->request->post())) {
            if (!is_null($respostaJaEnviada)) {
                $respostaJaEnviada->delete();
            }
            $alternativa = Alternativa::find()->where(['id' => $model->id_alternativa])->one();
            $model->id_questao = $alternativa->questao->id;
            $model->id_aluno = $user->aluno->id;
            if ($model->save()) {
                if ($totalRespostasAluno <= $totalQuestoes and $active == $totalQuestoes - 1) {
                    return $this->redirect(['finality-form']);
                }
                return $this->redirect(['listar-perguntas', 'active' => $active + 1]);
            }else{
                foreach ($model->errors as $key => $errors) {
                    foreach ($errors as $error) {
                        Yii::$app->session->addFlash('error', $error);
                    }
                }
            }
        }
        return $this->render('resposta', [
            'model' => $model,
            'perguntas' => $perguntas,
            'active' => $active,
            'respostas' => $respostas,
        ]);
    }

    public function actionFinalityForm()
    {
        return $this->render('finality');
    }

    public function actionGerarPdf()
    {
        /**
         * @var Pdf $pdf
         */
        $pdf = Yii::$app->pdf;
        $questoes = Questao::find()->all();
        $content = $this->renderPartial('_reportView', ['questoes' => $questoes]);
        $pdf->content = $content;
        return $pdf->render();
    }
}