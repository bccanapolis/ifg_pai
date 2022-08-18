<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AmpleAdminAsset;
use lavrentiev\widgets\toastr\NotificationFlash;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AmpleAdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" style="font-size: 16px;">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | Processo de Avaliação Interno</title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<?php include_once "_preloader.php" ?>
<div id="main-wrapper">
    <?php include_once "_top.php" ?>
    <?php include_once "_left.php" ?>

    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb border-bottom">
            <div class="row">
                <div
                        class="
                col-lg-3 col-md-4 col-xs-12
                justify-content-start
                d-flex
                align-items-center
              "
                >
                    <h5 class="font-weight-medium text-uppercase mb-0"><?= $this->title ?></h5>
                </div>
                <div
                        class="
                col-lg-9 col-md-8 col-xs-12
                d-flex
                justify-content-start justify-content-md-end
                align-self-center
              "
                >
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0 p-0">
                            <!--                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>-->
                            <!--                            <li class="breadcrumb-item active" aria-current="page">-->
                            <!--                                Dashboard-->
                            <!--                            </li>-->
                            <?= Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]);
                            ?>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="page-content container-fluid">
            <?=
            NotificationFlash::widget([
                'options' => [
                    "closeButton" => true,
                    "progressBar" => true,
                ]
            ]); ?>
            <?= $content ?>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center">
            <?= date('Y') ?> &copy; PAI - Todos os direitos reservados
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
