<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Avaliacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avaliacao-form">

    <?php
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        if(is_array($message) and isset($message[0])){
            echo '<div class="alert alert-', $key . '">' . $message[0] . "</div>\n";
        }elseif (is_string($message)){
            echo '<div class="alert alert-', $key . '">' . $message . "</div>\n";
        }
    }
    ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'nota')->textInput() ?>

    <?= $form->field($model, 'id_aluno')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Aluno::find()->orderBy(\app\models\Aluno::representingColumn())->asArray()->all(), 'id', \app\models\Aluno::representingColumn()),
        'options' => ['placeholder' => 'Choose Aluno'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'id_pergunta_avaliacao')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\PerguntaAvaliacao::find()->orderBy(\app\models\PerguntaAvaliacao::representingColumn())->asArray()->all(), 'id', \app\models\PerguntaAvaliacao::representingColumn()),
        'options' => ['placeholder' => 'Choose Pergunta avaliacao'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

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
