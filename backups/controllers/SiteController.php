<?php

namespace app\controllers;

use app\models\Questao;
use app\models\Resposta;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'login' => [
                'class' => 'SimpleSamlPhp\Actions\LoginAction',
                'simplesamlphpComponentName' => 'simplesamlphp',
                'redirectAfterLoginTo' => ['/site/index'],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionMain()
    {
        $this->layout = 'landing/main.php';
        return $this->render('index');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionViewProfile()
    {
        $id = Yii::$app->user->id;
        return $this->render('profile-user', [
            'model' => User::find()->where(['id'=>$id])->one(),
        ]);
    }

    public function actionIndex()
    {
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();
        $countCorretas = 0;
        $totalPerguntas = 0;
        if ($user->aluno) {
            $aluno_id = $user->aluno->id;

            $year = date('Y');
            $semestre = ((date('m') <= 7) ? 1 : 2);

            $totalPerguntas = Questao::find()->orderBy(['id' => SORT_ASC])
                ->innerJoin('disciplina', 'disciplina.id = questao.id_disciplina')
                ->where(['disciplina.ano' => $year])
                ->where(['disciplina.semestre' => $semestre])
                ->orderBy('id_disciplina')
                ->count();

            $countCorretas = Resposta::find()->leftJoin('questao', 'resposta.id_questao = questao.id')
                ->leftJoin('disciplina', 'disciplina.id = questao.id_disciplina')
                ->leftJoin('alternativa', 'resposta.id_alternativa = alternativa.id')
                ->where(['resposta.id_aluno' => $aluno_id, 'disciplina.ano' => $year, 'disciplina.semestre' => $semestre, 'alternativa.correta'=>true])
                ->distinct('questao.id')->count();
        }

        return $this->render('main', [
            'countCorretas' => $countCorretas,
            'totalPerguntas' => $totalPerguntas,
            'user' => $user,
        ]);
    }
}
