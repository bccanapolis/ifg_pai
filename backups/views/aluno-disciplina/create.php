<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AlunoDisciplina */

$this->title = 'Create Aluno Disciplina';
$this->params['breadcrumbs'][] = ['label' => 'Aluno Disciplina', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-disciplina-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
