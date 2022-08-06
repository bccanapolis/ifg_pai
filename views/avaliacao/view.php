<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = $model->{$model::representingColumn()};
$this->params['breadcrumbs'][] = ['label' => 'Avaliacao', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avaliacao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
            if (webvimark\modules\UserManagement\models\User::hasPermission("deletar")) {
        ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php            }
        ?>
    </p>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'nota',
        [
            'attribute' => 'aluno.'.\app\models\Aluno::representingColumn(),
            'label' => 'Id Aluno',
        ],
        [
            'attribute' => 'perguntaAvaliacao.'.\app\models\PerguntaAvaliacao::representingColumn(),
            'label' => 'Id Pergunta Avaliacao',
        ],
        [
            'attribute' => 'disciplina.'.\app\models\Disciplina::representingColumn(),
            'label' => 'Id Disciplina',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>

<?php?>
    </div>
</div>
