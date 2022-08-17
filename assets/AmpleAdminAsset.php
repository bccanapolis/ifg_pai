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
class AmpleAdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'ampleadmin/css/sidebar-nav.min.css',
        'ampleadmin/css/jquery.toast.css',
        'ampleadmin/css/morris.css',
        'ampleadmin/css/animate.css',
        'ampleadmin/css/style.css',
        'ampleadmin/css/default.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css',
        'apexcharts/apexcharts.css',
        'css/main.css'
    ];

    public $js = [
        'ampleadmin/js/sidebar-nav.min.js',
        'ampleadmin/js/jquery.slimscroll.js',
        'ampleadmin/js/waves.js',
        'ampleadmin/js/jquery.waypoints.js',
        'ampleadmin/js/jquery.counterup.min.js',
        'ampleadmin/js/jquery.sparkline.min.js',
        'ampleadmin/js/custom.min.js',
        'ampleadmin/js/dashboard1.js',
        'apexcharts/apexcharts.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
