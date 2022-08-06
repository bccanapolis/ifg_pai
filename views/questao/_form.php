<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $modelQuestao app\models\Questao */
/* @var $form yii\widgets\ActiveForm */

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Address: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Address: " + (index + 1))
    });
});
';

$this->registerJs($js);
?>

<div class="questao-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'id' => 'dynamic-form']); ?>

    <?= $form->errorSummary($modelQuestao); ?>

    <?= $form->field($modelQuestao, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?php
        $nome = false;
        if ($modelQuestao->arquivo){
            $nome = HTML::a($modelQuestao->arquivo, '@web' . $modelQuestao->getUploadedFileUrl('arquivo'));
        }
        echo $form->field($modelQuestao, 'arquivo')->widget(\kartik\widgets\FileInput::classname(), [
        'pluginOptions' => [
            'showRemove' => false,
            'showCaption' => false,
            'showUpload' => false,
            'browseLabel' => 'Selecione um arquivo',
            'initialPreview' => $nome,
            'overwriteInitial' => true
        ]
    ]); ?>

    <?= $form->field($modelQuestao, 'enunciado')->textarea() ?>

    <?= $form->field($modelQuestao, 'id_disciplina')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Disciplina::find()->orderBy(\app\models\Disciplina::representingColumn())->asArray()->all(), 'id', \app\models\Disciplina::representingColumn()),
        'options' => ['placeholder' => 'Selecione a Disciplina'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div id="panel-option-values" class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-check-square-o"></i> Alternativas</h3>
        </div>

        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper',
            'widgetBody' => '.form-options-body',
            'widgetItem' => '.form-options-item',
            'min' => 1,
            'limit' => 6,
            'insertButton' => '.add-item',
            'deleteButton' => '.delete-item',
            'model' => $modelsAlternativas[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'descricao',
                'correta'
            ],
        ]); ?>

        <table class="table table-bordered table-striped margin-b-none">
            <tbody class="form-options-body">
            <?php foreach ($modelsAlternativas as $index => $modelAlternativas): ?>
                <tr class="form-options-item">
                    <td class="vcenter">
                        <?= $form->field($modelAlternativas, "[{$index}]descricao")->textInput(['maxlength' => true]) ?>
                    </td>
                    <td>
                        <?= $form->field($modelAlternativas, "[{$index}]correta")->dropDownList([0 => "Incorreta", 1 => "Correta"]); ?>
                    </td>
                    <td class="text-center">
                        <button type="button" class="delete-item btn btn-danger btn-xs" style="margin-top: 20px">
                            <i class="fa fa-minus"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2" class="text-right">
                    <button type="button" class="add-item btn btn-success btn-sm"><span class="fa fa-plus"></span> Nova
                        Alternativa
                    </button>
                </td>
            </tr>
            </tfoot>
        </table>
        <?php DynamicFormWidget::end(); ?>
    </div>

    <div class="form-group">
        <?php
        $class_button = '';
        $nomeButton = '';
        if ($modelQuestao->isNewRecord) {
            $class_button = 'btn btn-success';
            $nomeButton = 'Create';
        } else {
            $class_button = 'btn btn-primary';
            $nomeButton = 'Update';
        }


        echo Html::submitButton($nomeButton, ['class' => $class_button])
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
