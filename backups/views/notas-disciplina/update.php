<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NotasDisciplina */

$this->title = 'Update Notas Disciplina: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Notas Disciplina', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notas-disciplina-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
