<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\Disciplina */
/* @var $form yii\widgets\ActiveForm */

$years = array_combine(range(date("Y", 1456790400), date("Y") + 5), range(date("Y", 1456790400), date("Y") + 5));
?>

<div class="disciplina-matriz-form row">
    <div class="col-xs-0 col-xs-12 col-md-offset-1 col-md-10">
    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 12,
        'attributes' => [
            'nome' => ['type' => Form::INPUT_TEXT, 'columnOptions' => ['colspan' => 12],],
            'sigla' => ['type' => Form::INPUT_TEXT, 'columnOptions' => ['colspan' => 12],],
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
