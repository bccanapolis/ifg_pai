<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->{$model::representingColumn()};
$this->params['breadcrumbs'][] = ['label' => 'Disciplina', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disciplina-view">

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
        <?php }
        ?>
    </p>

    <?php
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div class="alert alert-', $key . '">' . $message . "</div>\n";
    }
    ?>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'ano',
            'semestre',
            [
                'attribute' => 'coordenacao.professor.primeiro_nome',
                'label' => 'Coordenacao',
            ],
            [
                'attribute' => 'professor.primeiro_nome',
                'label' => 'Professor',
            ],
            [
                'attribute' => 'disciplina.nome',
                'label' => 'Disciplina',
            ],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
</div>
