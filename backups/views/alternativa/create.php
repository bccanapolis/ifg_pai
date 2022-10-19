<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Alternativa */

$this->title = 'Create Alternativa';
$this->params['breadcrumbs'][] = ['label' => 'Alternativa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alternativa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
