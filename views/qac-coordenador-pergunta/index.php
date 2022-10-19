<?php

/* @var $this yii\web\View */

/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'QAC Coordenador Pergunta';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="curso-index">

    <div>
        <?= Html::a('Adicionar ' . $this->title . ' <i class="fa fa-plus-circle"></i>', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <br/>
    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'enunciado:ntext',
//        [
//            'attribute' => 'curso_id',
//            'value' => function ($model) {
//                if ($model->curso_id != NULL) {
//                    return $model->curso->{\app\models\Curso::representingColumn()};
//                } else {
//                    return NULL;
//                }
//            },
//            'contentOptions' => ['class' => 'text-center'],
//            'filterType' => GridView::FILTER_SELECT2,
//            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Curso::find()->asArray()->orderBy(\app\models\Curso::representingColumn())->all(), 'id', \app\models\Curso::representingColumn()),
//            'filterWidgetOptions' => [
//                'pluginOptions' => ['allowClear' => true],
//            ],
//            'filterInputOptions' => ['placeholder' => 'Curso', 'id' => 'grid--curso_id'],
//            "groupEvenCssClass" => 'text-primary',
//            "groupOddCssClass" => 'text-primary',
//        ],
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-aluno']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'summary' => '',
        'export' => false,
        'toolbar' => ['content' => '']

    ]); ?>

</div>