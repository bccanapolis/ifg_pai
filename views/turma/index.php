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
            'attribute' => 'professor_id',
            'value' => function ($model) {
                if ($model->professor_id != NULL) {
                    return $model->professor_id->{\app\models\Professor::representingColumn()};
                } else {
                    return NULL;
                }
            },
            'contentOptions' => ['class' => 'text-center'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Professor::find()->asArray()->orderBy(\app\models\Professor::representingColumn())->all(), 'id', \app\models\Professor::representingColumn()),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Professor', 'id' => 'grid--professor_id'],
            "groupEvenCssClass" => 'text-primary',
            "groupOddCssClass" => 'text-primary',
        ],
        [
            'attribute' => 'disciplina_id',
            'value' => function ($model) {
                if ($model->disciplina_id != NULL) {
                    return $model->disciplina_id->{\app\models\Disciplina::representingColumn()};
                } else {
                    return NULL;
                }
            },
            'contentOptions' => ['class' => 'text-center'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Disciplina::find()->asArray()->orderBy(\app\models\Disciplina::representingColumn())->all(), 'id', \app\models\Disciplina::representingColumn()),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Disciplina', 'id' => 'grid--disciplina_id'],
            "groupEvenCssClass" => 'text-primary',
            "groupOddCssClass" => 'text-primary',
        ],
        [
            'attribute' => 'coordenacao_id',
            'value' => function ($model) {
                if ($model->coordenacao_id != NULL) {
                    return $model->coordenacao_id->{\app\models\Coordenacao::representingColumn()};
                } else {
                    return NULL;
                }
            },
            'contentOptions' => ['class' => 'text-center'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Coordenacao::find()->asArray()->orderBy(\app\models\Coordenacao::representingColumn())->all(), 'id', \app\models\Coordenacao::representingColumn()),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Coordenacao', 'id' => 'grid--coordenacao_id'],
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