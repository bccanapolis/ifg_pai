<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Alternativa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alternativa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'descricao')->textInput() ?>

    <?= $form->field($model, 'correta')->checkbox() ?>

    <?= $form->field($model, 'id_questao')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Questao::find()->orderBy(\app\models\Questao::representingColumn())->asArray()->all(), 'id', \app\models\Questao::representingColumn()),
        'options' => ['placeholder' => 'Choose Questao'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
