<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = $model->{$model::representingColumn()};
$this->params['breadcrumbs'][] = ['label' => 'Questao', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questao-view">

    <p>
        <?= Html::a('Update', ['update2', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'enunciado:ntext',
            [
                'attribute' => 'disciplina.' . \app\models\Disciplina::representingColumn(),
                'label' => 'Disciplina',
            ],
//            'imagem:ntext',
            [
                'attribute' => 'imagem',
                'value' => function ($model) {
                    if ($model->imagem != NULL) {
                        return "<img src='" . Url::to([$model->imagem]) . "' class='img-thumbnail'>";
                    } else {
                        return NULL;
                    }
                },
                'format'=>'html'
            ]
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>

        <?php $query = app\models\Alternativa::find()->where(['id_questao' => $model->id]);
        $dataProvider = new yii\data\ActiveDataProvider([
            'query' => $query,
        ]);

        $form = kartik\widgets\ActiveForm::begin(['action' => Url::to(['alternativa/batchupdate', 'id' => $model->id, 'return' => 'questao'])]);

        echo kartik\builder\TabularForm::widget([
            'dataProvider' => $dataProvider,
            'form' => $form,
            'checkboxColumn' => false,
            'actionColumn' => false,
            'attributes' => [
//                'id' => [
//                    'type' => kartik\builder\TabularForm::INPUT_STATIC,
//                    'label' => 'id',
//                    'columnOptions' => ['hAlign' => GridView::ALIGN_RIGHT, 'width' => '90px']
//                ],
                'descricao' => [
                    'type' => kartik\builder\TabularForm::INPUT_STATIC,
                    'label' => 'Descrição',
                    'columnOptions' => ['hAlign' => GridView::ALIGN_RIGHT, 'width' => '90px']
                ],
                'correta' => [
                    'type' => kartik\builder\TabularForm::INPUT_STATIC,
                    'label' => 'Correta',
                    'value' => function($model){
                        if($model->correta){
                            return "Sim";
                        }else{
                            return "Não";
                        }

                    },
                    'columnOptions' => ['hAlign' => GridView::ALIGN_RIGHT, 'width' => '90px']
                ],
//                'id_questao' => [
//                    'type' => kartik\builder\TabularForm::INPUT_STATIC,
//                    'label' => 'id_questao',
//                    'columnOptions' => ['hAlign' => GridView::ALIGN_RIGHT, 'width' => '90px']
//                ],
            ],
            'gridSettings' => [
                'floatHeader' => true,
                'panel' => [
                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>Alternativas</h3>',
                    'type' => GridView::TYPE_PRIMARY,
                ],
                'summary' => '',
            ]
        ]);

        kartik\widgets\ActiveForm::end();

        ?>
    </div>
</div>
