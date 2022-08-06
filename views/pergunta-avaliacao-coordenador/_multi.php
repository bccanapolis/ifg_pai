<?php

use app\models\Alternativa;
use yii\helpers\Html;

?>
<td>
    <?= $form->field($parcel, 'enunciado')->textarea([
        'rows' => 5,
        'id' => "perguntaavaliacaocoordenador_{$key}_enunciado",
        'name' => "PerguntaAvaliacaoCoordenador[$key][enunciado]",
    ])->label(false) ?>

</td>
<td>

    <?php
    echo Html::button('(-) Excluir', [
        'class' => 'product-remove-pergunta-avaliacao-coordenador-button btn btn-danger btn-outline',
    ]) ?>
</td>
