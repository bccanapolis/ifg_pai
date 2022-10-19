<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Aluno */

$this->title = 'Coordenação';
$this->params['breadcrumbs'][] = ['label' => 'Coordenação', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Create';
?>
<div class="aluno-create">

    <h1><?= ''//Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
