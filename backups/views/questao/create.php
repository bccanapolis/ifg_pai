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


    <?php
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        if(is_array($message) and isset($message[0])){
            echo '<div class="alert alert-', $key . '">' . $message[0] . "</div>\n";
        }elseif (is_string($message)){
            echo '<div class="alert alert-', $key . '">' . $message . "</div>\n";
        }
    }
    ?>

    <h1><?= ''//Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelQuestao' => $modelQuestao,
        'modelsAlternativas' => $modelsAlternativas,
    ]) ?>

</div>
