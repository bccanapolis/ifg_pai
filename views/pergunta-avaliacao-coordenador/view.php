<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = $model->{$model::representingColumn()};
$this->params['breadcrumbs'][] = ['label' => 'Pergunta Avaliacao', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pergunta-avaliacao-view">

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
        'enunciado:ntext',

    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>

<?php    $query = app\models\Avaliacao::find()->where(['id_pergunta_avaliacao'=> $model->id])->indexBy('id_pergunta_avaliacao');
    $dataProvider = new yii\data\ActiveDataProvider([
        'query' => $query,
    ]);

    $form = kartik\widgets\ActiveForm::begin(['action'=>Url::to(['avaliacao/batchupdate','id'=>$model->id,'return'=>'pergunta-avaliacao'])]);

    echo kartik\builder\TabularForm::widget([
        'dataProvider'=>$dataProvider,
        'form'=>$form,
        'checkboxColumn'=>false,
        'actionColumn'=>false,
        'attributes'=>[
            'id'=>[
            'type'=>kartik\builder\TabularForm::INPUT_STATIC,
            'label'=>'id',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
            ],
            'nota'=>[
            'type'=>kartik\builder\TabularForm::INPUT_STATIC,
            'label'=>'nota',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
            ],
            'id_aluno'=>[
            'type'=>kartik\builder\TabularForm::INPUT_STATIC,
            'label'=>'id_aluno',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
            ],
            'id_pergunta_avaliacao'=>[
            'type'=>kartik\builder\TabularForm::INPUT_STATIC,
            'label'=>'id_pergunta_avaliacao',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
            ],
        ],
        'gridSettings'=>[
            'floatHeader'=>true,
            'panel'=>[
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>Avaliacao</h3>',
                'type' => GridView::TYPE_PRIMARY,
            ]
        ]
    ]);

    kartik\widgets\ActiveForm::end();

?>
    </div>
</div>
