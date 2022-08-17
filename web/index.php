<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

// registra o autoloader do Composer
require __DIR__ . '/../vendor/autoload.php';

// inclui o arquivo da classe Yii
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

// carrega a configuração da aplicação
$config = require __DIR__ . '/../config/web.php';

// cria, configura e executa a aplicação
(new yii\web\Application($config))->run();