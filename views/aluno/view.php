<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = $model->{$model::representingColumn()};
$this->params['breadcrumbs'][] = ['label' => 'Aluno', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-view">

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
        'primeiro_nome',
        'ultimo_nome',
        'matricula',
        'cpf',
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

<?php    $query = app\models\AlunoDisciplina::find()->where(['id_aluno'=> $model->id])->indexBy('id_aluno');
    $dataProvider = new yii\data\ActiveDataProvider([
        'query' => $query,
    ]);

    $form = kartik\widgets\ActiveForm::begin(['action'=>Url::to(['aluno-disciplina/batchupdate','id'=>$model->id,'return'=>'aluno'])]);

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
            'id_disciplina'=>[
            'type'=>kartik\builder\TabularForm::INPUT_STATIC,
            'label'=>'id_disciplina',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
            ],
            'id_aluno'=>[
            'type'=>kartik\builder\TabularForm::INPUT_STATIC,
            'label'=>'id_aluno',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
            ],
        ],
        'gridSettings'=>[
            'floatHeader'=>true,
            'panel'=>[
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>AlunoDisciplina</h3>',
                'type' => GridView::TYPE_PRIMARY,
            ]
        ]
    ]);

    kartik\widgets\ActiveForm::end();

    $query = app\models\Avaliacao::find()->where(['id_aluno'=> $model->id])->indexBy('id_aluno');
    $dataProvider = new yii\data\ActiveDataProvider([
        'query' => $query,
    ]);

    $form = kartik\widgets\ActiveForm::begin(['action'=>Url::to(['avaliacao/batchupdate','id'=>$model->id,'return'=>'aluno'])]);

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
            'id_disciplina'=>[
            'type'=>kartik\builder\TabularForm::INPUT_STATIC,
            'label'=>'id_disciplina',
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

    $query = app\models\Resposta::find()->where(['id_aluno'=> $model->id])->indexBy('id_aluno');
    $dataProvider = new yii\data\ActiveDataProvider([
        'query' => $query,
    ]);

    $form = kartik\widgets\ActiveForm::begin(['action'=>Url::to(['resposta/batchupdate','id'=>$model->id,'return'=>'aluno'])]);

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
            'id_questao'=>[
            'type'=>kartik\builder\TabularForm::INPUT_STATIC,
            'label'=>'id_questao',
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
