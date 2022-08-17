<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $perguntas app\models\Questao[] */
/* @var $pergunta app\models\Questao */

$this->title = "Obrigado por sua avaliação!";
$this->params['breadcrumbs'][] = ['label' => 'Resposta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="text-center" style="padding: 20px; background: #2f323e; color: #fff">
    <?= Html::img(['site/images/logo_bcc.png'], ['width'=>'60%']) ?><br><br><br>
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <p style="font-size: 15px">
                A Coordenação do curso de Bacharelado em Ciência da Computação agradece pelo tempo dispendido para esta avaliação. <br>
                <b>Lembre-se de que isso é para o nosso crescimento.</b>
            </p>
        </div>
    </div>
</div>