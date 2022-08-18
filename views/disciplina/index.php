<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Disciplina';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="disciplina-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <div class="text-right">
        <?= Html::a('Criar Disciplina <i class="fa fa-plus-circle"></i>', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    
    <br />

<?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false, ],
        'nome:ntext',
        'ano',
        'semestre',
        [
                'attribute' => 'id_professor',
                'value' => function($model){
                    if($model->id_professor!=NULL){
                        return $model->professor->{\app\models\Professor::representingColumn()};
                    }else{
                        return NULL;
                    }
                },
                'contentOptions' => ['class' => 'text-center'],
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Professor::find()->asArray()->orderBy(\app\models\Professor::representingColumn())->all(), 'id', \app\models\Professor::representingColumn()),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Professor', 'id' => 'grid--id_professor'],
                "groupEvenCssClass" => 'text-primary',
                "groupOddCssClass" => 'text-primary',
            ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-disciplina']],
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
            'headingOptions'=>[
                'class' => 'bg-dark',
            ]
        ],
        'summary' => '',
        'export' => false,
        // your toolbar can include the additional full export menu
        'toolbar' => [
            'content'=>
                Html::button('<i class="glyphicon glyphicon-plus"></i>', [
                    'type'=>'button', 
                    'title'=>'Add Book', 
                    'class'=>'btn btn-success'
                ]) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
                    'class' => 'btn btn-default', 
                    'title' => 'Reset Grid'
                ]),
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
