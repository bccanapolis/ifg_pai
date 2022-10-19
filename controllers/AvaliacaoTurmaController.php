<?php

namespace app\controllers;

use app\models\Coordenacao;
use app\models\ModelBase;
use app\models\QacProfessor;
use app\models\QacProfessorComentario;
use app\models\QacProfessorPergunta;
use app\models\Turma;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class AvaliacaoTurmaController extends \yii\web\Controller
{
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
     * Lists all Professor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => QacProfessor::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Professor model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Professor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QacProfessor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QacProfessor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Professor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();
        if (is_null($user->aluno)) {
            Yii::$app->session->addFlash('error', 'Somente alunos podem responder ao Questionário...');
            return $this->redirect(['site/index']);
        }

        $totalPerguntas = QacProfessorPergunta::find()->count();
        if ($totalPerguntas == 0) {
            Yii::$app->session->addFlash('error', 'Não há perguntas de avaliação cadastradas!');
            return $this->redirect(['site/index']);
        }

        $model = new QacProfessor();

        $turmas = Turma::find()->where(['semestre' => 2, 'ano' => 2022])->all();

        if (empty($turmas)) {
            Yii::$app->session->addFlash('info', 'Obrigado! Você não possui mais turmas para serem avaliadas...');
            return $this->redirect(['site/index']);
        }

        if ($model->load(Yii::$app->request->post())) {
            $modelsAvaliacao = ModelBase::createMultiple(QacProfessor::classname());
            ModelBase::loadMultiple($modelsAvaliacao, Yii::$app->request->post());

            $respostas = Yii::$app->request->post()['QacProfessor'];
            $turma_id = $respostas['turma_id'];
            if (!$turma_id) {
                Yii::$app->session->addFlash('error', 'Selecione uma disciplina para avaliar primeiro.');
                return $this->redirect(['avaliacao/create']);
            }
            unset($respostas['turma_id']);

            $flag = true;
            foreach ($respostas as $resposta) {
                $avaliacao = new QacProfessor();
                $avaliacao->attributes = $resposta;
                $avaliacao->aluno_id = $user->aluno->id;
                $avaliacao->turma_id = $turma_id;
                if ($avaliacao->validate()) {
                    $avaliacao->save();
                } else {
                    $flag = false;
                    foreach ($avaliacao->errors as $key => $error) {
                        Yii::$app->session->addFlash('error', $error);
                    }
                }
            }


            if ($flag) {
                $modelComentario = new QacProfessorComentario();
                if ($modelComentario->load(Yii::$app->request->post())) {
                    if ($modelComentario->texto != '' and !is_null($modelComentario->texto)) {
                        $modelComentario->turma_id = $turma_id;
                        $modelComentario->save();
                    }
                }
                Yii::$app->session->addFlash('success', 'Avaliação respondida com sucesso!');
                return $this->redirect(['avaliacao/create']);
            } else {
                return $this->redirect(['avaliacao/create']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'turmas' => $turmas,
            ]);
        }
    }

    /**
     * Updates an existing Professor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
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
     * Deletes an existing Professor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

}
