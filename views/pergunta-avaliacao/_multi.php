<?php

use app\models\Alternativa;
use yii\helpers\Html;

?>
<td>
    <?= $form->field($parcel, 'enunciado')->textarea([
        'rows' => 5,
        'id' => "perguntaavaliacao_{$key}_enunciado",
        'name' => "PerguntaAvaliacao[$key][enunciado]",
    ])->label(false) ?>

</td>
<td>

    <?php
    echo Html::button('(-) Excluir', [
        'class' => 'product-remove-pergunta-avaliacao-button btn btn-danger btn-outline',
    ]) ?>
</td>
