<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'site/css/style.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css',
        'apexcharts/apexcharts.css'
    ];
    public $js = [
        'https://unpkg.com/scrollreveal@4.0.5/dist/scrollreveal.min.js',
        'site/js/main.min.js',
        'apexcharts/apexcharts.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
