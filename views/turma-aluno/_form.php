<?php

use app\models\Aluno;
use app\models\Coordenacao;
use app\models\QacCoordenadorPergunta;
use app\models\QacProfessorPergunta;
use app\models\Turma;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Disciplina */
/* @var $form kartik\widgets\ActiveForm */
?>

<div class="aluno-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 12,
        'attributes' => [
            'aluno_id' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => ArrayHelper::map(Aluno::find()->asArray()->orderBy(Aluno::representingColumn())->all(), 'id', Aluno::representingColumn()), 'columnOptions' => ['colspan' => 8], 'options' => ['placeholder' => 'Aluno']],
            'turma_id' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => ArrayHelper::map(Turma::find()->asArray()->orderBy(Turma::representingColumn())->all(), 'id', Turma::representingColumn()), 'columnOptions' => ['colspan' => 8], 'options' => ['placeholder' => 'Coordenação']],
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
