<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Disciplina */

$this->title = 'Create Disciplina Grade';
$this->params['breadcrumbs'][] = ['label' => 'Disciplina', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disciplina-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
