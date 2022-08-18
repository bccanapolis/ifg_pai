<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Avaliacao';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="avaliacao-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Avaliacao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'nota',
        [
                'attribute' => 'id_aluno',
                'label' => 'Id Aluno',
                'value' => function($model){
                    if($model->id_aluno!=NULL){
                        return $model->aluno->{\app\models\Aluno::representingColumn()};
                    }else{
                        return NULL;
                    }
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Aluno::find()->asArray()->orderBy(\app\models\Aluno::representingColumn())->all(), 'id', \app\models\Aluno::representingColumn()),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Aluno', 'id' => 'grid--id_aluno']
            ],
        [
                'attribute' => 'id_pergunta_avaliacao_coordenador',
                'label' => 'Id Pergunta Avaliacao Coordenador',
                'value' => function($model){
                    if($model->id_pergunta_avaliacao_coordenador!=NULL){
                        return $model->perguntaAvaliacaoCoordenador->{\app\models\PerguntaAvaliacaoCoordenador::representingColumn()};
                    }else{
                        return NULL;
                    }
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\PerguntaAvaliacaoCoordenador::find()->asArray()->orderBy(\app\models\PerguntaAvaliacaoCoordenador::representingColumn())->all(), 'id', \app\models\PerguntaAvaliacaoCoordenador::representingColumn()),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Pergunta avaliacao', 'id' => 'grid--id_pergunta_avaliacao']
            ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-avaliacao']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'summary' => '',
        'export' => false,
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_PDF => false
                ]
            ]) ,
        ],
    ]); ?>

</div>
