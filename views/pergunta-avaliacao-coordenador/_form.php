<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $modelsPergunta app\models\PerguntaAvaliacao */
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

<div class="pergunta-avaliacao-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div id="panel-option-values" class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-check-square-o"></i> Perguntas</h3>
        </div>

        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper',
            'widgetBody' => '.form-options-body',
            'widgetItem' => '.form-options-item',
            'min' => 1,
            'limit' => 6,
            'insertButton' => '.add-item',
            'deleteButton' => '.delete-item',
            'model' => $modelsPergunta[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'enunciado',
            ],
        ]); ?>
        <table class="table table-bordered table-striped margin-b-none">
            <tbody class="form-options-body">
            <?php foreach ($modelsPergunta as $index => $modelPergunta): ?>
                <tr class="form-options-item">
                    <td class="vcenter">
                        <?= $form->field($modelPergunta, "[{$index}]enunciado")->textInput(['maxlength' => true]) ?>
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
                    <button type="button" class="add-item btn btn-success btn-sm">
                        <span class="fa fa-plus"></span> Nova Pergunta
                    </button>
                </td>
            </tr>
            </tfoot>
        </table>
        <?php DynamicFormWidget::end(); ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Create', ['class' =>'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
