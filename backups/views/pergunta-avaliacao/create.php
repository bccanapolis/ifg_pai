<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $modelsPergunta app\models\PerguntaAvaliacao */

$this->title = 'Perguntas de Avaliação';
$this->params['breadcrumbs'][] = ['label' => 'Pergunta Avaliacao', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pergunta-avaliacao-create">

    <h1><?= ''//Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelsPergunta' => $modelsPergunta,
    ]) ?>

</div>
