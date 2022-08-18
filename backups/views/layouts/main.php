<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AmpleAdminAsset;
use lavrentiev\widgets\toastr\NotificationFlash;

AmpleAdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="fix-header">
<?php $this->beginBody() ?>
<style>
    #toast-container *{
        opacity: .95 !important;
    }
</style>
<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<div id="wrapper">
    <?php include_once "_top.php" ?>
    <?php include_once "_left.php" ?>
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title"><?= $this->title ?></h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <?=  Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]);
                    ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>


        </div>
        <div class="page-content container-fluid">
            <?=
            NotificationFlash::widget([
                'options' => [
                    "closeButton" => true,
                    "progressBar" => true,
                ]
            ]);
//            foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
//                if(is_array($message) and isset($message[0])){
//                    echo '<div class="alert alert-', $key . '">' . $message[0] . "</div>\n";
//                }elseif (is_string($message)){
//                    echo '<div class="alert alert-', $key . '">' . $message . "</div>\n";
//                }
//            }
            ?>
            <?= $content ?>
        </div>
        <footer class="footer text-center"> <?= date('Y') ?> &copy; PAI - Todos os direitos reservados</footer>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
