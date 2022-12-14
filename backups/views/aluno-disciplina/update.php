<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AlunoDisciplina */

$this->title = 'Update Aluno Disciplina: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Aluno Disciplina', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aluno-disciplina-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
