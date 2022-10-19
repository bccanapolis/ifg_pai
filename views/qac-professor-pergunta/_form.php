<?php

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
            'enunciado' => ['type' => Form::INPUT_TEXTAREA, 'columnOptions' => ['colspan' => 12], 'options' => ['placeholder' => 'Enunciado']],
//            'curso_id' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => ArrayHelper::map(Curso::find()->asArray()->orderBy(Curso::representingColumn())->all(), 'id', Curso::representingColumn()), 'columnOptions' => ['colspan' => 9], 'options' => ['placeholder' => 'Curso']],
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
