<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\Disciplina */
/* @var $form yii\widgets\ActiveForm */

$years = array_combine(range(date("Y", 1456790400), date("Y") + 5), range(date("Y", 1456790400), date("Y") + 5));
?>

<div class="disciplina-form row">
    <div class="col-xs-0 col-xs-12 col-md-offset-1 col-md-10">
    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 12,
        'attributes' => [
//            'nome' => ['type' => Form::INPUT_TEXT, 'columnOptions' => ['colspan' => 12],],
            'id_disciplina_matriz' => ['type' => Form::INPUT_WIDGET, 'columnOptions' => ['colspan' => 12],
                'widgetClass' => '\kartik\widgets\Select2',
                'options' => [
                    'options' => [
                        'placeholder' => 'Selecione a Disciplina da Grade'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                    'data' => \yii\helpers\ArrayHelper::map(\app\models\DisciplinaMatriz::find()->orderBy(\app\models\DisciplinaMatriz::representingColumn())->asArray()->all(), 'id', \app\models\DisciplinaMatriz::representingColumn())
                ]
            ],
            'ano' => [
                'type' => Form::INPUT_WIDGET, 'columnOptions' => ['colspan' => 6],
                'widgetClass' => '\kartik\widgets\Select2',
                'options' => [
                    'data' => $years,
                    'options' => [
                        'placeholder' => 'Selecione o Ano'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ],
            ],
            'semestre' => [
                'type' => Form::INPUT_RADIO_LIST,
                'items' => [1 => "1", 2 => "2"],
                'options' => [
                    'inline' => true,
                ],
                'columnOptions' => ['colspan' => 6]
            ],
            'id_professor' => ['type' => Form::INPUT_WIDGET, 'columnOptions' => ['colspan' => 12],
                'widgetClass' => '\kartik\widgets\Select2',
                'options' => [
                    'options' => [
                        'placeholder' => 'Selecione o Professor'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                    'data' => \yii\helpers\ArrayHelper::map(\app\models\Professor::find()->orderBy(\app\models\Professor::representingColumn())->asArray()->all(), 'id', \app\models\Professor::representingColumn())
                ]
            ],
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
