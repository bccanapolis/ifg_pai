<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ComentarioAvaliacaoCoordenador */

$this->title = 'Create Comentario Avaliacao Coordenador';
$this->params['breadcrumbs'][] = ['label' => 'Comentario Avaliacao Coordenador', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentario-avaliacao-coordenador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
