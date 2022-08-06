<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Questões';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
    $('.search-form').toggle(1000);
    return false;
});";
$this->registerJs($search);
?>
<div class="questao-index">

    <p>
        <?= Html::a('Adicionar Questão', ['create2'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Imprimir Questões', ['/questionario/gerar-pdf'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'enunciado:ntext',
        [
            'attribute' => 'id_disciplina',
            'label' => 'Disciplina',
            'value' => function($model){
                if($model->id_disciplina!=NULL){
                    return $model->disciplina->{\app\models\Disciplina::representingColumn()};
                }else{
                    return NULL;
                }
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Disciplina::find()->asArray()->orderBy(\app\models\Disciplina::representingColumn())->all(), 'id', \app\models\Disciplina::representingColumn()),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Disciplina', 'id' => 'grid--id_disciplina']
        ],
        [
            'class' => 'thtmorais\easyiigii\extensions\ActionColumn',
            'buttons'=>[
                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['questao/update2'], [
                        'title' => Yii::t('yii', 'Update'),
                    ]);
                }
            ]
        ],
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-questao']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'export' => false,
        'summary' => '',
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