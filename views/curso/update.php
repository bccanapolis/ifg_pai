<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Curso */

$this->title = $model->daa . ' - ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Curso', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="curso-update">

    <h1><?= Html::encode('Update Curso: ' . ' ' . $model->daa . ' - ' . $model->nome) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
