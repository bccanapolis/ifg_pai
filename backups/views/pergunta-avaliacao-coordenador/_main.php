<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
    <div class="product-form">

        <?php $form = ActiveForm::begin([
            'enableClientValidation' => false,
        ]); ?>

        <?= ''//$model->errorSummary($form);     ?>


        <?php

        echo Html::button('(+) Pergunta', [
            'id' => 'product-new-pergunta-avaliacao-coordenador-button',
            'class' => 'pull-right btn btn-primary btn-s'
        ]);

        // parcel table
        $parcel = new \app\models\PerguntaAvaliacaoCoordenador();
        $parcel->loadDefaultValues();
        echo '<table id="product-parcels" class="table table-condensed table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>' . $parcel->getAttributeLabel('enunciado') . '</th>';
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
        echo '<tr id="product-new-pergunta-avaliacao-coordenador-block"  style="display: none;">';
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
        $('#product-new-pergunta-avaliacao-coordenador-button').on('click', function () {
            
            $('#product-parcels').find('tbody')
                .append('<tr>' + $('#product-new-pergunta-avaliacao-coordenador-block').html().replace(/__id__/g, parcel_k) + '</tr>');

            parcel_k += 1;
            // remove parcel button
            $(document).on('click', '.product-remove-pergunta-avaliacao-coordenador-button', function () {
                $(this).closest('tbody tr').remove();
            });
         });";

$this->registerJs($mjs, \yii\web\View::POS_END);
