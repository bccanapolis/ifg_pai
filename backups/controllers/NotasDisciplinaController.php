<?php

namespace app\controllers;

use app\models\User;
use Yii;
use app\models\NotasDisciplina;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotasDisciplinaController implements the CRUD actions for NotasDisciplina model.
 */
class NotasDisciplinaController extends Controller
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
     * Lists all NotasDisciplina models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => NotasDisciplina::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NotasDisciplina model.
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
     * Creates a new NotasDisciplina model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NotasDisciplina();
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();

        if ($user->aluno) {
            $model->id_aluno = $user->aluno->id;
        } else {
            Yii::$app->session->addFlash('error', 'Somente alunos podem responder ao Questionário...');
            return $this->redirect(['site/index']);
        }

        if (NotasDisciplina::find()->where(['id_aluno' => $model->id_aluno, 'ano' => 2022, 'semestre' => 1])->count() > 0) {
            Yii::$app->session->addFlash('error', 'Você já selecionou a disciplina desse semestre!');
            return $this->redirect(['/site/index']);
        }

        $disciplinas = Yii::$app->db->createCommand("select d.id as id, d.nome as nome from disciplina d
            inner join aluno_disciplina ad on ad.id_disciplina = d.id
            where ad.id_aluno = :aluno_id and d.ano = 2022 and d.semestre = 1", [':aluno_id' => $user->aluno->id])->queryAll();

        if ($model->load(Yii::$app->request->post())) {
            if (NotasDisciplina::find()->where(['id_aluno' => $model->id_aluno, 'id_disciplina' => $model->id_disciplina])->count() <= 0) {
                $model->save();
                Yii::$app->session->addFlash('success', "Disciplina {$model->disciplina->nome} selecionada!");
                return $this->redirect(['/site/index']);
            } else {
                Yii::$app->session->addFlash('error', 'Você já selecionou a disciplina desse semestre!');
            }
        }
        return $this->render('create', [
            'model' => $model,
            'disciplinas' => $disciplinas,
        ]);
    }

    /**
     * Updates an existing NotasDisciplina model.
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
     * Deletes an existing NotasDisciplina model.
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
     * Finds the NotasDisciplina model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NotasDisciplina the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NotasDisciplina::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}