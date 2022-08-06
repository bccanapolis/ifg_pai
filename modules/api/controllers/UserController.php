<?php

namespace app\modules\api\controllers;

use app\models\User;
use yii\rest\ActiveController;
use yii\web\Response;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function actionLogin()
    {
        $username = \Yii::$app->request->getBodyParam('username');
        $password = \Yii::$app->request->getBodyParam('password');

        $user = User::findByUsername($username);
        if (is_null($user)){
            return ["error"=>"Login/Senha incorretos."];
        }
        if ($user->validatePassword($password)){
            return $user;
        }
        return ["error"=>"Login/Senha incorretos."];
    }
}