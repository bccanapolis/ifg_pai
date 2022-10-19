<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Resposta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resposta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'id_aluno')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Aluno::find()->orderBy(\app\models\Aluno::representingColumn())->asArray()->all(), 'id', \app\models\Aluno::representingColumn()),
        'options' => ['placeholder' => 'Choose Aluno'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'id_alternativa')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Alternativa::find()->orderBy(\app\models\Alternativa::representingColumn())->asArray()->all(), 'id', \app\models\Alternativa::representingColumn()),
        'options' => ['placeholder' => 'Choose Alternativa'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
