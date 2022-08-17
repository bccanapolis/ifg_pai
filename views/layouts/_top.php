<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<style>
    @media screen and (max-width: 650px) {
        #title-pai{
            display: none;
        }
    }
</style>
<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">

        <span class="text-white font-bold"
              style="font-size: 25px; margin: 15px 0px 20px 20px; position: absolute">
            <span id="title-pai">Processo de Avaliação Interno -</span> PAI
        </span>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li>
                <a class="nav-toggler open-close waves-effect waves-light "
                   href="javascript:void(0)"><i class="fa fa-bars"></i></a>
            </li>

            <li>
                <a class="nav-link dropdown-toggle waves-effect waves-dark" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false"
                   href="#"> <i class="fa fa-user"></i> &nbsp
                    <b class="hidden-xs"><?= ucfirst(Yii::$app->user->username) ?> </b>
                    <i class="fa fa-chevron-down"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY"
                     style="padding-bottom: 0; width: 300px">
                    <div class="text-center d-flex no-block align-items-center p-5 mb-2 border-bottom"
                         style="padding: 20px">
                        <div class="">
                            <i class="fa fa-user fa-4x"></i>
                        </div>
                        <div class="ml-2">
                            <h4 class="mb-0"><?= ucfirst(Yii::$app->user->username) ?></h4>
                            <br>
                            <a href="<?= Url::to(['site/view-profile']) ?>"
                               class="btn btn btn-primary text-white mt-2 btn-rounded">
                                <i class="fa fa-user-circle"></i> Meu Perfil
                            </a>
                            <a href="<?= Url::to(['user-management/auth/logout']) ?>"
                               class="btn btn btn-danger text-white mt-2 btn-rounded">
                                <i class="fa fa-power-off mr-1 ml-1"></i> Logout
                            </a>
                            <br><br>
                        </div>
                    </div>
                </div>

            </li>
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>
<!-- End Top Navigation -->