<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Alternativa */

$this->title = 'Update Alternativa: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Alternativa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="alternativa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
