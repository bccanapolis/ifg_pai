<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = $model->{$model::representingColumn()};
$this->params['breadcrumbs'][] = ['label' => 'Alternativa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alternativa-view">

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
        'descricao:ntext',
        'correta:boolean',
        [
            'attribute' => 'questao.'.\app\models\Questao::representingColumn(),
            'label' => 'Id Questao',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>

<?php    $query = app\models\Resposta::find()->where(['id_alternativa'=> $model->id])->indexBy('id_alternativa');
    $dataProvider = new yii\data\ActiveDataProvider([
        'query' => $query,
    ]);

    $form = kartik\widgets\ActiveForm::begin(['action'=>Url::to(['resposta/batchupdate','id'=>$model->id,'return'=>'alternativa'])]);

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
            'id_aluno'=>[
            'type'=>kartik\builder\TabularForm::INPUT_STATIC,
            'label'=>'id_aluno',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
            ],
            'id_alternativa'=>[
            'type'=>kartik\builder\TabularForm::INPUT_STATIC,
            'label'=>'id_alternativa',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
            ],
        ],
        'gridSettings'=>[
            'floatHeader'=>true,
            'panel'=>[
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>Resposta</h3>',
                'type' => GridView::TYPE_PRIMARY,
            ]
        ]
    ]);

    kartik\widgets\ActiveForm::end();

?>
    </div>
</div>
