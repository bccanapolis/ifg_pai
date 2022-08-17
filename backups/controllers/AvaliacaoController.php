<?php

namespace app\controllers;

use app\models\ComentarioAvaliacao;
use app\models\ModelBase;
use app\models\PerguntaAvaliacao;
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
class AvaliacaoController extends Controller
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
            'query' => Avaliacao::find(),
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
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();
        if (!$user->aluno) {
            Yii::$app->session->addFlash('error', 'Somente alunos podem responder ao Questionário...');
            return $this->redirect(['site/index']);
        }
        $totalPerguntas = PerguntaAvaliacao::find()->count();
        if ($totalPerguntas == 0) {
            Yii::$app->session->addFlash('error', 'Não há perguntas de avaliação cadastradas!');
            return $this->redirect(['site/index']);
        }
        $model = new Avaliacao();
//        $disciplinas = Yii::$app->db->createCommand('select disciplina.id, disciplina.nome from disciplina
//				left join aluno_disciplina as ad on ad.id_disciplina = disciplina.id
//                right join (select * from questao where id not in (
//                select questao.id from questao right join resposta r on questao.id = r.id_questao where id_aluno = :aluno_id)) as t on disciplina.id = t.id_disciplina
//                where ad.id_aluno = :aluno_id', [':aluno_id' => $user->aluno->id])->queryAll();
        $disciplinas = Yii::$app->db->createCommand("select d.id, d.nome from disciplina d
            inner join aluno_disciplina ad on ad.id_disciplina = d.id
            where d.id not in (
                select avaliacao.id_disciplina from avaliacao
                inner join aluno a on avaliacao.id_aluno = a.id
                inner join pergunta_avaliacao pa on avaliacao.id_pergunta_avaliacao = pa.id
            where a.id = :aluno_id
        ) and ad.id_aluno = :aluno_id and d.ano = 2022 and d.semestre = 1", [':aluno_id' => $user->aluno->id])->queryAll();

        if (empty($disciplinas)) {
            Yii::$app->session->addFlash('info', 'Obrigado! Você não possui mais disciplinas para serem avaliadas...');
            return $this->redirect(['site/index']);
        }

        if ($model->load(Yii::$app->request->post())) {
            $modelsAvaliacao = ModelBase::createMultiple(Avaliacao::classname());
            ModelBase::loadMultiple($modelsAvaliacao, Yii::$app->request->post());

            $respostas = Yii::$app->request->post()['Avaliacao'];
            $disciplina_id = $respostas['id_disciplina'];
            if (!$disciplina_id) {
                Yii::$app->session->addFlash('error', 'Selecione uma disciplina para avaliar primeiro.');
                return $this->redirect(['avaliacao/create']);
            }
            unset($respostas['id_disciplina']);

            $flag = true;
            foreach ($respostas as $resposta) {
                $avaliacao = new Avaliacao();
                $avaliacao->attributes = $resposta;
                $avaliacao->id_aluno = $user->aluno->id;
                $avaliacao->id_disciplina = $disciplina_id;
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
                $modelComentario = new ComentarioAvaliacao();
                if ($modelComentario->load(Yii::$app->request->post())) {
                    if ($modelComentario->texto != '' and !is_null($modelComentario->texto)) {
                        $modelComentario->id_disciplina = $disciplina_id;
                        $modelComentario->ano = 2022;
                        $modelComentario->semestre = 1;
                        $modelComentario->save();
                    }
                }
                Yii::$app->session->addFlash('success', 'Avaliação respondida com sucesso!');
                return $this->redirect(['avaliacao/create']);
            } else
                return $this->redirect(['avaliacao/create']);
        }
        return $this->render('create', [
            'model' => $model,
            'disciplinas' => $disciplinas,
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