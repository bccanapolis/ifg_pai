<?php

use app\models\Alternativa;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$year = date('Y');
$semestre = ((date('m') <= 7) ? 1 : 2);
?>
    <div class="product-form">

        <?php $form = ActiveForm::begin([
            'enableClientValidation' => false,
        ]); ?>

        <?php
        $nome = false;
        if ($model->product->arquivo) {
            $nome = HTML::a($model->product->arquivo, '@web' . $model->product->getUploadedFileUrl('arquivo'));
        }
        echo $form->field($model->product, 'arquivo')->widget(\kartik\widgets\FileInput::classname(), [
            'pluginOptions' => [
                'showRemove' => false,
                'showCaption' => false,
                'showUpload' => false,
                'browseLabel' => 'Selecione um arquivo',
                'initialPreview' => $nome,
                'overwriteInitial' => true
            ]
        ]); ?>

        <?= $form->field($model->product, 'enunciado')->textarea(['rows' => 5]) ?>

        <?= $form->field($model->product, 'id_disciplina')->widget(\kartik\widgets\Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\app\models\Disciplina::find()->where(['ano' => $year, 'semestre' => $semestre])->orderBy(\app\models\Disciplina::representingColumn())->asArray()->all(), 'id', \app\models\Disciplina::representingColumn()),
            'options' => ['placeholder' => 'Selecione a Disciplina'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>


        <?php

        echo Html::button('(+) Alternativa', [
            'id' => 'product-new-alternativa-button',
            'class' => 'pull-right btn btn-primary btn-s'
        ]);

        // parcel table
        $parcel = new Alternativa();
        $parcel->loadDefaultValues();
        echo '<table id="product-parcels" class="table table-condensed table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>' . $parcel->getAttributeLabel('descricao') . '</th>';
        echo '<th>' . $parcel->getAttributeLabel('correta') . '</th>';
        echo '<td>&nbsp;</td>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // existing parcels fields
        foreach ($model->parcels as $key => $_parcel) {
            echo '<tr>';
            echo $this->render('_multi', [
                'key' => $_parcel->isNewRecord ? (strpos($key, 'new') !== false ? $key : 'new' . $key) : $_parcel->id,
                'form' => $form,
                'parcel' => $_parcel,
            ]);
            echo '</tr>';
        }

        // new parcel fields
        echo '<tr id="product-new-alternativa-block"  style="display: none;">';
        echo $this->render('_multi', [
            'key' => '__id__',
            'form' => $form,
            'parcel' => $parcel,
        ]);
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';


        ?>



        <?= Html::submitButton('SALVAR', ['class' => 'btn btn-success']); ?>
        <?php ActiveForm::end(); ?>

    </div>


<?php


$mjs = "var parcel_k =  0;
        $('#product-new-alternativa-button').on('click', function () {
            
            $('#product-parcels').find('tbody')
                .append('<tr>' + $('#product-new-alternativa-block').html().replace(/__id__/g, parcel_k) + '</tr>');

            parcel_k += 1;
            // remove parcel button
            $(document).on('click', '.product-remove-alternativa-button', function () {
                $(this).closest('tbody tr').remove();
            });
         });";

$this->registerJs($mjs, \yii\web\View::POS_END);
