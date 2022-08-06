<?php

namespace app\controllers;

use Yii;
use app\models\ComentarioAvaliacao;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComentarioAvaliacaoController implements the CRUD actions for ComentarioAvaliacao model.
 */
class ComentarioAvaliacaoController extends Controller
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
     * Lists all ComentarioAvaliacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = \app\models\User::find()->where(['id' => Yii::$app->user->id])->one();


        if (!$user) {
            Yii::$app->session->addFlash('error', 'Faça login');
            return $this->redirect(['/']);
        }

        $dataProvider = null;

        if ($user->professor) {
            $dataProvider = new ActiveDataProvider([
                'query' => ComentarioAvaliacao::find()->innerJoin('disciplina', 'disciplina.id = comentario_avaliacao.id_disciplina')->where(['disciplina.id_professor' => $user->professor->id])->orderBy(['ano'=>SORT_DESC, 'semestre'=>SORT_DESC]),
            ]);
        } else if(boolval($user->superadmin)) {
            $dataProvider = new ActiveDataProvider([
                'query' => ComentarioAvaliacao::find()->innerJoin('disciplina', 'disciplina.id = comentario_avaliacao.id_disciplina')->orderBy(['ano'=>SORT_DESC, 'semestre'=>SORT_DESC]),
            ]);
        } else {
            Yii::$app->session->addFlash('error', 'Faça login como professor');
            return $this->redirect(['/']);
        }

        $dataProvider->setPagination(false);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ComentarioAvaliacao model.
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
     * Creates a new ComentarioAvaliacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ComentarioAvaliacao();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ComentarioAvaliacao model.
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
     * Deletes an existing ComentarioAvaliacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the ComentarioAvaliacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ComentarioAvaliacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ComentarioAvaliacao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}