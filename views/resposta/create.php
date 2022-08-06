<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Resposta */

$this->title = 'Create Resposta';
$this->params['breadcrumbs'][] = ['label' => 'Resposta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resposta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="btn-group" role="group">
        <button type="button" class="btn btn-default">1</button>
        <button type="button" class="btn btn-default active">2</button>
        <button type="button" class="btn btn-default">3</button>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
