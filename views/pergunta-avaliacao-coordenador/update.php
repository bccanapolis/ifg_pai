<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PerguntaAvaliacao */

$this->title = 'Update Pergunta Avaliação: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pergunta Avaliação', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pergunta-avaliacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
