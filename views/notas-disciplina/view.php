<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = $model->{$model::representingColumn()};
$this->params['breadcrumbs'][] = ['label' => 'Notas Disciplina', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notas-disciplina-view">

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

    <?php 
        foreach (Yii::$app->session->getAllFlashes() as $key => $message){
            echo '<div class="alert alert-', $key.'">'.$message."</div>\n";
        }
    ?>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'aluno.'.\app\models\Aluno::representingColumn(),
            'label' => 'Id Aluno',
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
