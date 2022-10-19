<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Gráficos';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="card">

    <div class="row no-gutters">
        <div class="col-sm-12">
            <div class="card-body">
                <h3><a href="<?= Url::to(['grafico/professor']) ?>">Gráfico dos Professores</a></h3>
<!--                <h3><a href="--><?//= Url::to(['grafico/coordenador']) ?><!--">Gráfico do Coordenador</a></h3>-->
<!--                <h3><a href="--><?//= Url::to(['grafico/add']) ?><!--">Gráfico ADD</a></h3>-->
            </div>

        </div>
    </div>
</div>
