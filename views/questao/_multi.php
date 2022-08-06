<?php

use app\models\Alternativa;
use yii\helpers\Html;

?>
<td>
    <?= $form->field($parcel, 'descricao')->textInput([
        'id' => "alternativa_{$key}_descricao",
        'name' => "Alternativa[$key][descricao]",
    ])->label(false) ?>

</td>
<td>
    <?= $form->field($parcel, 'correta')->dropDownList([0 => "Incorreta", 1 => "Correta"],
        [
            'id' => "alternativa_{$key}_correta",
            'name' => "Alternativa[$key][correta]",
        ]
    )->label(false) ?>
</td>

<td>

    <?php
    echo Html::button('(-) Excluir', [
        'class' => 'product-remove-alternativa-button btn btn-danger btn-outline',
    ]) ?>
</td>
