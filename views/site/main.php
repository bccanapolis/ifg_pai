<?php

/* @var $this yii\web\View */
/* @var $totalPerguntas integer */
/* @var $countCorretas integer */

use yii\helpers\Html;

$this->title = 'Página Inicial';
?>
<div class="inicial-index">
    <?php if ($user->aluno){ ?>
    <div class="row">
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="white-box ">
                <h5 class="box-title text-uppercase">ADD (2019/2)</h5>
                <div class="row container-fluid">
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <h2 class="display-5"><i class="fa fa-file-text text-success"></i></h2>
                    </div>
                    <div class="col-lg-8 col-sm-6 col-xs-12 text-right">
                        <h2 class="display-6"><span class="font-normal"><?= $countCorretas ?>/<?= $totalPerguntas ?></span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
