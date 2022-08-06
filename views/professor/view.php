<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = $model->{$model::representingColumn()};
$this->params['breadcrumbs'][] = ['label' => 'Professor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="professor-view">

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
        'siape',
        'primeiro_nome',
        'ultimo_nome',
        'tipo',
        [
            'attribute' => 'user.'.\app\models\User::representingColumn(),
            'label' => 'User',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>

<?php    $query = app\models\Disciplina::find()->where(['id_professor'=> $model->id])->indexBy('id_professor');
    $dataProvider = new yii\data\ActiveDataProvider([
        'query' => $query,
    ]);

    $form = kartik\widgets\ActiveForm::begin(['action'=>Url::to(['disciplina/batchupdate','id'=>$model->id,'return'=>'professor'])]);

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
            'nome'=>[
            'type'=>kartik\builder\TabularForm::INPUT_STATIC,
            'label'=>'nome',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
            ],
            'ano'=>[
            'type'=>kartik\builder\TabularForm::INPUT_STATIC,
            'label'=>'ano',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
            ],
            'semestre'=>[
            'type'=>kartik\builder\TabularForm::INPUT_STATIC,
            'label'=>'semestre',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
            ],
            'id_professor'=>[
            'type'=>kartik\builder\TabularForm::INPUT_STATIC,
            'label'=>'id_professor',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
            ],
        ],
        'gridSettings'=>[
            'floatHeader'=>true,
            'panel'=>[
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>Disciplina</h3>',
                'type' => GridView::TYPE_PRIMARY,
            ]
        ]
    ]);

    kartik\widgets\ActiveForm::end();

?>
    </div>
</div>
