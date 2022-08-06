<?php

namespace app\modules\api\controllers;

use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

class PostsController extends ActiveController
{
    public $modelClass = 'app\models\Posts';

    public function actions()       // Just read only rest api
    {
        $actions = parent::actions();
        unset($actions['delete'], $actions['create'], $actions['update']);
        return $actions;
    }

    public function behaviors(){
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        $behaviors['authenticator'] = [
            //'class' => HttpBasicAuth::className(),
            'class' => HttpBearerAuth::className(),
            //'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }
}