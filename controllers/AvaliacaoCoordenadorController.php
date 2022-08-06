<?php

namespace app\controllers;

use app\models\AvaliacaoCoordenador;
use app\models\ComentarioAvaliacao;
use app\models\ComentarioAvaliacaoCoordenador;
use app\models\ModelBase;
use app\models\PerguntaAvaliacao;
use app\models\PerguntaAvaliacaoCoordenador;
use app\models\User;
use Yii;
use app\models\Avaliacao;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AvaliacaoController implements the CRUD actions for Avaliacao model.
 */
class AvaliacaoCoordenadorController extends Controller
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
     * Lists all Avaliacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AvaliacaoCoordenador::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Avaliacao model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Avaliacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\db\Exception
     */
    public function actionCreate()
    {
        $year = 2022;
        $semestre = 1;

        $user = User::find()->where(['id' => Yii::$app->user->id])->one();
        if (!$user->aluno) {
            Yii::$app->session->addFlash('error', 'Somente alunos podem responder a Avaliação do Coordenador...');
            return $this->redirect(['site/index']);
        }
        $totalPerguntas = PerguntaAvaliacaoCoordenador::find()->count();
        if ($totalPerguntas == 0) {
            Yii::$app->session->addFlash('error', 'Não há perguntas de avaliação cadastradas!');
            return $this->redirect(['site/index']);
        }
        $model = new AvaliacaoCoordenador();
        if (AvaliacaoCoordenador::find()->where(['ano' => 2022])->andWhere(['semestre' => 1])->andWhere(['id_aluno' => $user->aluno->id])->all()) {
            Yii::$app->session->addFlash('error', 'Avaliação Coordenador já respondida!');
            return $this->redirect(['site/index']);
        }
        if ($model->load(Yii::$app->request->post())) {
            $modelsAvaliacao = ModelBase::createMultiple(AvaliacaoCoordenador::classname());
            ModelBase::loadMultiple($modelsAvaliacao, Yii::$app->request->post());

            $respostas = Yii::$app->request->post()['AvaliacaoCoordenador'];

            $flag = true;
            foreach ($respostas as $resposta) {
                $avaliacao = new AvaliacaoCoordenador();
                $avaliacao->attributes = $resposta;
                $avaliacao->id_aluno = $user->aluno->id;

                $avaliacao->ano = $year;
                $avaliacao->semestre = $semestre;
                if ($avaliacao->validate()) {
                    $avaliacao->save();
                } else {
                    $flag = false;
                    foreach ($avaliacao->errors as $key => $error) {
                        Yii::$app->session->addFlash('danger', $error);
                    }
                }
            }


            if ($flag) {
                $modelComentario = new ComentarioAvaliacaoCoordenador();
                if ($modelComentario->load(Yii::$app->request->post())){
                    if ($modelComentario->texto != '' and !is_null($modelComentario->texto)){
                        $modelComentario->ano = $year;
                        $modelComentario->semestre = $semestre;
                        $modelComentario->save();
                    }
                }
                Yii::$app->session->addFlash('success', 'Avaliação respondida com sucesso!');
                return $this->redirect(['site/index']);
            } else
                return $this->redirect(['avaliacao-coordenador/create']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Avaliacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Avaliacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Avaliacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Avaliacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Avaliacao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}