<?php

use app\models\Aluno;
use app\models\Coordenacao;
use app\models\QacCoordenadorPergunta;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

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
            'nota' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => \app\models\QacCoordenador::$notas],
            'ano' => ['type' => Form::INPUT_TEXT, 'columnOptions' => ['colspan' => 2], 'options' => ['placeholder' => 'Ano']],
            'semestre' => ['type' => Form::INPUT_TEXT, 'columnOptions' => ['colspan' => 2], 'options' => ['placeholder' => 'Semestre']],
            'aluno_id' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => ArrayHelper::map(Aluno::find()->asArray()->orderBy(Aluno::representingColumn())->all(), 'id', Aluno::representingColumn()), 'columnOptions' => ['colspan' => 8], 'options' => ['placeholder' => 'Aluno']],
            'pergunta_id' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => ArrayHelper::map(QacCoordenadorPergunta::find()->asArray()->orderBy(QacCoordenadorPergunta::representingColumn())->all(), 'id', QacCoordenadorPergunta::representingColumn()), 'columnOptions' => ['colspan' => 8], 'options' => ['placeholder' => 'Pergunta']],
            'coordenacao_id' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => ArrayHelper::map(Coordenacao::find()->asArray()->orderBy(Coordenacao::representingColumn())->all(), 'id', Coordenacao::representingColumn()), 'columnOptions' => ['colspan' => 8], 'options' => ['placeholder' => 'Coordenação']],
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
