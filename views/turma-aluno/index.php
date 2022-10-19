<?php

/* @var $this yii\web\View */

/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'QAC Coordenador Comentário';
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
        'ano',
        'semestre',
        [
            'attribute' => 'aluno_id',
            'value' => function ($model) {
                if ($model->aluno_id != NULL) {
                    return $model->aluno_id->{\app\models\Aluno::representingColumn()};
                } else {
                    return NULL;
                }
            },
            'contentOptions' => ['class' => 'text-center'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Aluno::find()->asArray()->orderBy(\app\models\Aluno::representingColumn())->all(), 'id', \app\models\Aluno::representingColumn()),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Aluno', 'id' => 'grid--aluno_id'],
            "groupEvenCssClass" => 'text-primary',
            "groupOddCssClass" => 'text-primary',
        ],
        [
            'attribute' => 'turma_id',
            'value' => function ($model) {
                if ($model->turma_id != NULL) {
                    return $model->turma_id->{\app\models\Turma::representingColumn()};
                } else {
                    return NULL;
                }
            },
            'contentOptions' => ['class' => 'text-center'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Turma::find()->asArray()->orderBy(\app\models\Turma::representingColumn())->all(), 'id', \app\models\Turma::representingColumn()),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Turma', 'id' => 'grid--turma_id'],
            "groupEvenCssClass" => 'text-primary',
            "groupOddCssClass" => 'text-primary',
        ],
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