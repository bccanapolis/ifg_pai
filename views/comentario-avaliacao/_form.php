<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ComentarioAvaliacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comentario-avaliacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'texto')->textInput() ?>

    <?= $form->field($model, 'id_disciplina')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Disciplina::find()->orderBy(\app\models\Disciplina::representingColumn())->asArray()->all(), 'id', \app\models\Disciplina::representingColumn()),
        'options' => ['placeholder' => 'Choose Disciplina'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
