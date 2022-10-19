<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $modelQuestao app\models\Questao */
/* @var $modelsAlternativas app\models\Questao */

$this->title = 'Adicionar Questão';
$this->params['breadcrumbs'][] = ['label' => 'Questão', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questao-create">

    <?= $this->render('_main', [
        'model' => $model,
    ]) ?>

</div>
