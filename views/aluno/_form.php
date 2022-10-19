<?php

use app\models\Curso;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aluno */
/* @var $form kartik\widgets\ActiveForm */
?>

<div class="aluno-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?php
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 12,
        'attributes' => [
            'primeiro_nome' => ['type' => Form::INPUT_TEXT, 'columnOptions' => ['colspan' => 12], 'options' => ['placeholder' => 'Enter Primeiro Nome...', 'maxlength' => 255]],
            'ultimo_nome' => ['type' => Form::INPUT_TEXT, 'columnOptions' => ['colspan' => 12], 'options' => ['placeholder' => 'Enter Ultimo Nome...', 'maxlength' => 255]],
            'matricula' => ['type' => Form::INPUT_TEXT, 'columnOptions' => ['colspan' => 12], 'options' => ['placeholder' => 'Enter Matricula...', 'maxlength' => 255]],
            'cpf' => ['type' => Form::INPUT_TEXT, 'columnOptions' => ['colspan' => 12], 'options' => ['placeholder' => 'Enter Cpf...', 'maxlength' => 255]],
            'user_id' => ['type' => Form::INPUT_DROPDOWN_LIST, 'columnOptions' => ['colspan' => 12], 'items' => ArrayHelper::map(\app\models\User::find()->asArray()->orderBy(\app\models\User::representingColumn())->all(), 'id', \app\models\User::representingColumn()), 'columnOptions' => ['colspan' => 6], 'options' => ['placeholder' => 'Usuário']],
            'curso_id' => ['type' => Form::INPUT_DROPDOWN_LIST, 'columnOptions' => ['colspan' => 12], 'items' => ArrayHelper::map(Curso::find()->asArray()->orderBy(Curso::representingColumn())->all(), 'id', Curso::representingColumn()), 'columnOptions' => ['colspan' => 6], 'options' => ['placeholder' => 'Curso']],
        ]
    ]);
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
