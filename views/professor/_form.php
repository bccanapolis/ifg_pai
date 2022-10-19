<?php

use kartik\builder\Form;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Professor */
/* @var $form kartik\widgets\ActiveForm */
?>

<div class="professor-form">

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
            'siape' => ['type' => Form::INPUT_TEXT, 'columnOptions' => ['colspan' => 12], 'options' => ['placeholder' => 'Enter Matricula...', 'maxlength' => 255]],
            'user_id' => ['type' => Form::INPUT_DROPDOWN_LIST, 'columnOptions' => ['colspan' => 12], 'items' => ArrayHelper::map(\app\models\User::find()->asArray()->orderBy(\app\models\User::representingColumn())->all(), 'id', \app\models\User::representingColumn()), 'options' => ['placeholder' => 'Usuário']],
            'tipo' => ['type' => Form::INPUT_DROPDOWN_LIST, 'columnOptions' => ['colspan' => 12], 'items' => \app\models\Professor::$tipos, 'options' => ['placeholder' => 'Curso']],
        ]
    ]);
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
