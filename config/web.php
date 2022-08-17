<?php
//use kartik\mpdf\Pdf;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name'=>'PAI - Processo de Avaliação Interna',
    'sourceLanguage' => 'pt-br',
    'language' => 'pt-br',
    'defaultRoute' => 'site/main',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'gka_cmJCa8t84DhHKmwM9Q8wTLd62mMH',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'webvimark\modules\UserManagement\components\UserConfig',

            // Comment this if you don't want to record user logins
//            'on afterLogin' => function($event) {
//                \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
//            }
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
//            'viewPath' => '@app/mailer',
            'useFileTransport' => true,
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'smtp.gmail.com',
//                'username' => '',
//                'password' => '',
//                'port' => '587',
//                'encryption' => 'tls',
//            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // 'class'=>'yii\rest\UrlRule',
                // 'pluralize'=>false,
                // 'controller'=>'api/posts'
            ],
        ],
        'simplesamlphp' => [
            'class' => 'SimpleSamlPhp\Components\Simplesamlphp',
            'autoloadPath' => '/home/computacaoifg/bccsp/lib/_autoload.php',
            'authSource' => 'default-sp',
        ],
//        'pdf' => [
//            'class' => Pdf::classname(),
//            'format' => Pdf::FORMAT_A4,
//            'orientation' => Pdf::ORIENT_PORTRAIT,
//            'destination' => Pdf::DEST_BROWSER,
//            // refer settings section for all configuration options
//        ]
    ],
    'params' => $params,
    'modules' => [
        'api' => [
            'class' => 'app\modules\api\ApiModule',
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
        ],

        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],
        'datecontrol' => [
            'class' => '\kartik\datecontrol\Module',
        ],
        'user-management' => [
            'class' => 'webvimark\modules\UserManagement\UserManagementModule',
            'on beforeAction'=>function(yii\base\ActionEvent $event) {
                if ( $event->action->uniqueId == 'user-management/auth/login' ){
                    $event->action->controller->layout = 'loginLayout.php';
                };
            },
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['*']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['*']
    ];
}

return $config;
