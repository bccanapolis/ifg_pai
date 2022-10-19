<?php

use app\models\Curso;
use kartik\builder\Form;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Disciplina */
/* @var $form yii\widgets\ActiveForm */

$years = array_combine(range(date("Y", 1456790400), date("Y") + 5), range(date("Y", 1456790400), date("Y") + 5));
?>

<div class="disciplina-form row">
    <div class="col-12">
        <?php $form = ActiveForm::begin(); ?>

        <?php
        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 12,
            'attributes' => [
                'nome' => ['type' => Form::INPUT_TEXT, 'columnOptions' => ['colspan' => 12], 'options' => ['placeholder' => 'Nome da disciplina']],
                'codigo' => ['type' => Form::INPUT_TEXT, 'columnOptions' => ['colspan' => 3], 'options' => ['placeholder' => 'Código']],
                'curso_id' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => ArrayHelper::map(Curso::find()->asArray()->orderBy(Curso::representingColumn())->all(), 'id', Curso::representingColumn()), 'columnOptions' => ['colspan' => 9], 'options' => ['placeholder' => 'Curso']],
            ]
        ]);
        ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
