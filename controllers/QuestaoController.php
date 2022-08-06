<?php

namespace app\controllers;

use app\models\Alternativa;
use app\models\QuestaoForm;
use Mpdf\Tag\A;
use Yii;
use app\models\Questao;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestaoController implements the CRUD actions for Questao model.
 */
class QuestaoController extends Controller
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
     * Lists all Questao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Questao::find()->orderBy(['id'=>SORT_DESC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Questao model.
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
     * Creates a new Questao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelQuestao = new Questao();
        $modelsAlternativas = [new Alternativa()];

        if ($modelQuestao->load(Yii::$app->request->post())) {

            $modelsAlternativas = Questao::createMultiple(Alternativa::classname());
            Questao::loadMultiple($modelsAlternativas, Yii::$app->request->post());

            // validate all models
            $valid = $modelQuestao->validate();
            $valid = Questao::validateMultiple($modelsAlternativas) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $modelQuestao->save(false)) {
                        $modelQuestao->updateAttributes(['imagem' => $modelQuestao->getUploadedFileUrl('arquivo')]);
                        $contadorAlternativasCorretas = 0;
                        foreach ($modelsAlternativas as $modelAlternativas) {
                            $modelAlternativas->id_questao = $modelQuestao->id;
                            if (! ($flag = $modelAlternativas->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                            if($modelAlternativas->correta){
                                $contadorAlternativasCorretas += 1;
                            }
                        }
                    }
                    if ($contadorAlternativasCorretas != 1){
                        Yii::$app->session->setFlash('error', 'Deve haver necessariamente uma alternativa correta!');
                        $transaction->rollBack();
                    }
                    else if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelQuestao->id]);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        if (empty($modelsAlternativas)){
            $modelsAlternativas = [new Alternativa];
        }
        return $this->render('create', [
            'modelQuestao' => $modelQuestao,
            'modelsAlternativas' => $modelsAlternativas
        ]);
    }

    public function actionCreate2()
    {
        $model = new QuestaoForm();
        $model->product = new Questao();
        $model->product->load(Yii::$app->request->post());

        if (Yii::$app->request->post()){
            if(count(Yii::$app->request->post()['Alternativa']) <= 1){
                Yii::$app->getSession()->setFlash('error', 'É necessário ao menos uma alternativa!');
                return $this->render('create2', ['model' => $model]);
            }
            $model->setParcels(Yii::$app->request->post()['Alternativa']);
            $contadorAlternativasCorretas = 0;
            foreach ($model->parcels as $parcel) {
                if($parcel->correta){
                    $contadorAlternativasCorretas += 1;
                }
            }
            if ($contadorAlternativasCorretas != 1){
                Yii::$app->session->setFlash('error', 'Deve haver necessariamente uma alternativa correta!');
                return $this->render('create2', ['model' => $model]);
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $model->product->updateAttributes(['imagem' => $model->product->getUploadedFileUrl('arquivo')]);
            Yii::$app->getSession()->setFlash('success', 'Questão criada com sucesso!');
            return $this->redirect(['view', 'id' => $model->product->id]);
        }
        return $this->render('create2', ['model' => $model]);
    }

    public function actionUpdate2($id)
    {
        $model = new QuestaoForm();
        $model->product = $this->findModel($id);
        $model->product->load(Yii::$app->request->post());
        if (Yii::$app->request->post()){
            if(count(Yii::$app->request->post()['Alternativa']) <= 1){
                Yii::$app->getSession()->setFlash('error', 'É necessário ao menos uma alternativa!');
                return $this->render('update2', ['model' => $model]);
            }
            $model->setParcels(Yii::$app->request->post()['Alternativa']);
        }

        if (Yii::$app->request->post() && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Questão atualizada com sucesso!');
            return $this->redirect(['view', 'id' => $model->product->id]);
        }
        return $this->render('update2', ['model' => $model]);
    }

    /**
     * Updates an existing Questao model.
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
     * Deletes an existing Questao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if ((\app\models\Alternativa::find()->where(['id_questao' => $id])->all())) {
            Yii::$app->session->setFlash('error', "Questao sendo usado em algum(a) Alternativa.");
            return $this->redirect(['index']);
        }
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Questao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Questao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Questao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}