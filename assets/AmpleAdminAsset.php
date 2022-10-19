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
        'ampleadmin/libs/apexcharts/dist/apexcharts.css',
        'ampleadmin/libs/fullcalendar/dist/fullcalendar.min.css',
        'ampleadmin/extra-libs/calendar/calendar.css',
        'ampleadmin/css/style.min.css',
        'css/main.css',
    ];

    public $js = [
        'ampleadmin/libs/jquery/dist/jquery.min.js',
        'ampleadmin/extra-libs/taskboard/js/jquery-ui.min.js',
        'ampleadmin/libs/bootstrap/dist/js/bootstrap.bundle.min.js',
        'ampleadmin/js/app.min.js',
        'ampleadmin/js/app.init.sidebar.js',
        'ampleadmin/js/app-style-switcher.js',
        'ampleadmin/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js',
        'ampleadmin/extra-libs/sparkline/sparkline.js',
        'ampleadmin/js/waves.js',
        'ampleadmin/js/sidebarmenu.js',
        'ampleadmin/js/feather.min.js',
        'ampleadmin/js/custom.min.js',
        'ampleadmin/libs/apexcharts/dist/apexcharts.min.js',
        'ampleadmin/js/pages/dashboards/dashboard1.js',
        'ampleadmin/libs/moment/min/moment.min.js',
        'ampleadmin/libs/fullcalendar/dist/fullcalendar.min.js',
        'ampleadmin/js/pages/calendar/cal-init.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
