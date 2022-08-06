<?php

namespace app\controllers;

use Yii;
use app\models\ComentarioAvaliacaoCoordenador;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
* ComentarioAvaliacaoCoordenadorController implements the CRUD actions for ComentarioAvaliacaoCoordenador model.
*/
class ComentarioAvaliacaoCoordenadorController extends Controller
{
    /**
    * @return array
    */
    public function behaviors(){
        return [
            'ghost-access'=> [
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
    * Lists all ComentarioAvaliacaoCoordenador models.
    * @return mixed
    */
    public function actionIndex(){
        $dataProvider = new ActiveDataProvider([
            'query' => ComentarioAvaliacaoCoordenador::find()->orderBy(['ano'=>SORT_DESC, 'semestre'=>SORT_DESC]),
        ]);
        $dataProvider->setPagination(false);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * Displays a single ComentarioAvaliacaoCoordenador model.
    * @param integer $id
    * @return mixed
    */
    public function actionView($id){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
    * Creates a new ComentarioAvaliacaoCoordenador model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
    public function actionCreate(){
        $model = new ComentarioAvaliacaoCoordenador();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
    * Updates an existing ComentarioAvaliacaoCoordenador model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    */
    public function actionUpdate($id){
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
    * Deletes an existing ComentarioAvaliacaoCoordenador model.
    * If deletion is successful, the browser will be redirected to the 'index' page.
    * @param integer $id
    * @return mixed
    */
    public function actionDelete($id){
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
    * Finds the ComentarioAvaliacaoCoordenador model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return ComentarioAvaliacaoCoordenador the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel($id){
        if (($model = ComentarioAvaliacaoCoordenador::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}