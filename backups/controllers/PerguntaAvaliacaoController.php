<?php

namespace app\controllers;

use app\models\Disciplina;
use app\models\ModelBase;
use app\models\PerguntaForm;
use Yii;
use app\models\PerguntaAvaliacao;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PerguntaAvaliacaoController implements the CRUD actions for PerguntaAvaliacao model.
 */
class PerguntaAvaliacaoController extends Controller
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
     * Lists all PerguntaAvaliacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PerguntaAvaliacao::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PerguntaAvaliacao model.
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
     * Creates a new PerguntaAvaliacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idDisciplina=null)
    {
        $modelsPergunta = [new PerguntaAvaliacao()];

        if (Yii::$app->request->post()) {
            $modelsPergunta = ModelBase::createMultiple(PerguntaAvaliacao::classname());
            ModelBase::loadMultiple($modelsPergunta, Yii::$app->request->post());

            // validate all models
            $valid = ModelBase::validateMultiple($modelsPergunta);

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    /**
                     * @var PerguntaAvaliacao $modelPergunta
                     */
                    foreach ($modelsPergunta as $modelPergunta) {
                        if (!($flag = $modelPergunta->save(false))) {
                            $transaction->rollBack();
                            break;
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['pergunta-avaliacao/index']);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelsPergunta' => (empty($modelsPergunta)) ? [new PerguntaAvaliacao] : $modelsPergunta
        ]);
    }

    /**
     * Updates an existing PerguntaAvaliacao model.
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
     * Deletes an existing PerguntaAvaliacao model.
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
     * Finds the PerguntaAvaliacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PerguntaAvaliacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PerguntaAvaliacao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionCreate2()
    {
        $model = new PerguntaForm();
        if (Yii::$app->request->post()){
            if(count(Yii::$app->request->post()['PerguntaAvaliacao']) <= 1){
                Yii::$app->getSession()->setFlash('danger', '?? necess??rio ao menos uma pergunta!');
                return $this->render('create2', ['model' => $model]);
            }
            $model->setParcels(Yii::$app->request->post()['PerguntaAvaliacao']);
        }

        if (Yii::$app->request->post() && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Quest??es adicionadas com sucesso!');
            return $this->redirect(['index']);
        }
        return $this->render('create2', ['model' => $model]);
    }

    public function actionUpdate2()
    {
        $model = new PerguntaForm();
        if (Yii::$app->request->post()){
            if(count(Yii::$app->request->post()['PerguntaAvaliacao']) <= 1){
                Yii::$app->getSession()->setFlash('danger', '?? necess??rio ao menos uma pergunta!');
                return $this->render('update2', ['model' => $model]);
            }
            $model->setParcels(Yii::$app->request->post()['PerguntaAvaliacao']);
        }

        if (Yii::$app->request->post() && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Quest??es atualizadas com sucesso!');
            return $this->redirect(['index']);
        }
        return $this->render('update2', ['model' => $model]);
    }
}