<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ComentarioAvaliacaoCoordenador */

$this->title = 'Update Comentario Avaliacao Coordenador: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comentario Avaliacao Coordenador', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comentario-avaliacao-coordenador-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
