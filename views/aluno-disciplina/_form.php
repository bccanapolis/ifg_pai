<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AlunoDisciplina */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aluno-disciplina-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'id_disciplina')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Disciplina::find()->orderBy(\app\models\Disciplina::representingColumn())->asArray()->all(), 'id', \app\models\Disciplina::representingColumn()),
        'options' => [
            'placeholder' => 'Choose Disciplina',
            'disabled' => (!is_null($model->id_disciplina))?true:false,
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'id_aluno')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Aluno::find()->orderBy(\app\models\Aluno::representingColumn())->asArray()->all(), 'id', \app\models\Aluno::representingColumn()),
        'options' => [
            'placeholder' => 'Choose Aluno',
            'multiple' => true,
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
