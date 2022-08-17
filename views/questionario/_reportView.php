<?php

use yii\helpers\Html;

/**
 * @var \app\models\Questao[] $questoes
 */
$year = date('Y');
$semestre = ((date('m') <= 7) ? 1 : 2);

\app\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= \yii\helpers\Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="">
<?php $this->beginBody() ?>

<div>
    <h2 class="text-center">Avaliação Diagnóstica do Discente</h2>
    <h6 class="text-center">Curso de Bacharelado em Ciência da Computação (<?= $year . '/' . $semestre ?>)</h6>
    <br>
    <p class="text-center">
        Aluno: _____________________________________________________________________________
    </p>
    <br>
    <div>
        <?php
        $letras = ['a','b','c','d','e','f','g','h','i','j'];
        foreach ($questoes as $key => $questao) {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading"><?= $key +1 ?>) <?= $questao->enunciado ?></div>
                <div class="panel-body">
                    <?php
                    if (!is_null($questao->imagem) && $questao->imagem != ""){
                        echo '<img src="' . \yii\helpers\Url::to([$questao->imagem]) . '" alt="" style="width: 100%">' . "<br>";
                    }
                    ?>
                    <?php foreach ($questao->alternativas as $key => $alternativa) { ?>
                        <p><b><?= strtoupper($letras[$key]) ?>.</b> <?= $alternativa->descricao ?> </p>
                    <?php } ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

</body>
</html>
<?php $this->endPage() ?>
