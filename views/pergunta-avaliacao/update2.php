<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Questao */

$this->title = 'Update Questão';
$this->params['breadcrumbs'][] = ['label' => 'Questão', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="questao-update">

    <h1><?= ''//Html::encode($this->title) ?></h1>

    <?= $this->render('_main', [
        'model' => $model,
    ]) ?>

</div>
