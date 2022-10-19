<?php

use app\models\Aluno;
use app\models\Coordenacao;
use app\models\Disciplina;
use app\models\Professor;
use app\models\QacProfessorPergunta;
use app\models\Turma;
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
            'ano' => ['type' => Form::INPUT_TEXT, 'columnOptions' => ['colspan' => 3], 'options' => ['placeholder' => 'Ano']],
            'semestre' => ['type' => Form::INPUT_TEXT, 'columnOptions' => ['colspan' => 3], 'options' => ['placeholder' => 'Semestre']],
            'professor_id' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => ArrayHelper::map(Professor::find()->asArray()->orderBy(Professor::representingColumn())->all(), 'id', Professor::representingColumn()), 'columnOptions' => ['colspan' => 8], 'options' => ['placeholder' => 'Aluno']],
            'disciplina_id' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => ArrayHelper::map(Disciplina::find()->asArray()->orderBy(Disciplina::representingColumn())->all(), 'id', Disciplina::representingColumn()), 'columnOptions' => ['colspan' => 8], 'options' => ['placeholder' => 'Disciplina']],
            'coordenacao_id' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => ArrayHelper::map(Coordenacao::find()->asArray()->orderBy(Coordenacao::representingColumn())->all(), 'id', Coordenacao::representingColumn()), 'columnOptions' => ['colspan' => 8], 'options' => ['placeholder' => 'Coordenação']],
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
