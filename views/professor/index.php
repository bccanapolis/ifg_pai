<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Professor';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="professor-index">

    <h1><?= ''//Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Adicionar Professor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'siape',
        'primeiro_nome',
        'ultimo_nome',
        'tipo',
        [
                'attribute' => 'user_id',
                'label' => 'User',
                'value' => function($model){
                    if($model->user_id!=NULL){
                        return $model->user->{\app\models\User::representingColumn()};
                    }else{
                        return NULL;
                    }
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\User::find()->asArray()->orderBy(\app\models\User::representingColumn())->all(), 'id', \app\models\User::representingColumn()),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'User', 'id' => 'grid--user_id']
            ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-professor']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'summary' => '',
        'export' => false,
        // your toolbar can include the additional full export menu
//        'toolbar' => [
//            '{export}',
//            ExportMenu::widget([
//                'dataProvider' => $dataProvider,
//                'columns' => $gridColumn,
//                'target' => ExportMenu::TARGET_BLANK,
//                'fontAwesome' => true,
//                'dropdownOptions' => [
//                    'label' => 'Full',
//                    'class' => 'btn btn-default',
//                    'itemsBefore' => [
//                        '<li class="dropdown-header">Export All Data</li>',
//                    ],
//                ],
//                'exportConfig' => [
//                    ExportMenu::FORMAT_PDF => false
//                ]
//            ]) ,
//        ],
    ]); ?>

</div>
