<?php

namespace app\controllers;

use Yii;
use app\models\AlunoDisciplina;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
* AlunoDisciplinaController implements the CRUD actions for AlunoDisciplina model.
*/
class AlunoDisciplinaController extends Controller
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
    * Lists all AlunoDisciplina models.
    * @return mixed
    */
    public function actionIndex(){
        $dataProvider = new ActiveDataProvider([
            'query' => AlunoDisciplina::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * Displays a single AlunoDisciplina model.
    * @param integer $id
    * @return mixed
    */
    public function actionView($id){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
    * Creates a new AlunoDisciplina model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
    public function actionCreate($idDisciplina = null){
        $model = new AlunoDisciplina();
        if (!is_null($idDisciplina)){
            $model->id_disciplina = $idDisciplina;
        }

        if ($model->load(Yii::$app->request->post())) {
            foreach ($model->id_aluno as $index => $aluno_id) {
                $alunoDisciplina = new AlunoDisciplina();
                $alunoDisciplina->id_aluno = $aluno_id;
                $alunoDisciplina->id_disciplina = $model->id_disciplina;
                $alunoDisciplina->save();
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
    * Updates an existing AlunoDisciplina model.
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
    * Deletes an existing AlunoDisciplina model.
    * If deletion is successful, the browser will be redirected to the 'index' page.
    * @param integer $id
    * @return mixed
    */
    public function actionDelete($id){
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
    * Finds the AlunoDisciplina model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return AlunoDisciplina the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel($id){
        if (($model = AlunoDisciplina::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}