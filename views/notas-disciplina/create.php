<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NotasDisciplina */

$this->title = 'Selecionar Disciplina para Adicionar Nota';
$this->params['breadcrumbs'][] = ['label' => 'Notas Disciplina', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notas-disciplina-create">

    <?= $this->render('_form', [
        'model' => $model,
        'disciplinas' => $disciplinas,
    ]) ?>

</div>
