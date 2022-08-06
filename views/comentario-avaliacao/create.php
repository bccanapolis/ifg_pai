<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ComentarioAvaliacao */

$this->title = 'Create Comentario Avaliacao';
$this->params['breadcrumbs'][] = ['label' => 'Comentario Avaliacao', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentario-avaliacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
