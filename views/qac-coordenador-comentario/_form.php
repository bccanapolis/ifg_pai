<?php

use app\models\Coordenacao;
use app\models\Curso;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

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
            'texto' => ['type' => Form::INPUT_TEXTAREA, 'columnOptions' => ['colspan' => 12], 'options' => ['placeholder' => 'Enunciado']],
            'ano' => ['type' => Form::INPUT_TEXT, 'columnOptions' => ['colspan' => 2], 'options' => ['placeholder' => 'Ano']],
            'semestre' => ['type' => Form::INPUT_TEXT, 'columnOptions' => ['colspan' => 2], 'options' => ['placeholder' => 'Semestre']],
            'coordenacao_id' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => ArrayHelper::map(Coordenacao::find()->asArray()->orderBy(Coordenacao::representingColumn())->all(), 'id', Coordenacao::representingColumn()), 'columnOptions' => ['colspan' => 8], 'options' => ['placeholder' => 'Coordenação']],
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
