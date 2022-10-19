<?php

use app\models\Professor;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->{$model::representingColumn()};
$this->params['breadcrumbs'][] = ['label' => 'Disciplina', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disciplina-view">

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
        <?php }
        ?>
    </p>

    <?php
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div class="alert alert-', $key . '">' . $message . "</div>\n";
    }
    ?>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'nome:ntext',
            'codigo',
            [
                'attribute' => 'curso.' . \app\models\Curso::representingColumn(),
                'label' => 'Curso',
            ],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
<!---->
<!--        --><?php //$query = app\models\Turma::find()->where(['id_disciplina' => $model->id]);
//        $dataProvider = new yii\data\ActiveDataProvider([
//            'query' => $query,
//        ]);
//
//        $form = kartik\widgets\ActiveForm::begin(['action' => Url::to(['aluno-disciplina/batchupdate', 'id' => $model->id, 'return' => 'disciplina'])]);
//
//        echo kartik\builder\TabularForm::widget([
//            'dataProvider' => $dataProvider,
//            'form' => $form,
//            'checkboxColumn' => false,
//            'actionColumn' => false,
//            'attributes' => [
////            'id'=>[
////            'type'=>kartik\builder\TabularForm::INPUT_STATIC,
////            'label'=>'id',
////            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
////            ],
////            'id_disciplina'=>[
////            'type'=>kartik\builder\TabularForm::INPUT_STATIC,
////            'label'=>'id_disciplina',
////            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
////            ],
//                'id_aluno' => [
//                    'type' => kartik\builder\TabularForm::INPUT_STATIC,
//                    'label' => 'id_aluno',
//                    'columnOptions' => ['hAlign' => GridView::ALIGN_RIGHT, 'width' => '90px']
//                ],
//            ],
//            'gridSettings' => [
//                'floatHeader' => true,
//                'panel' => [
//                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>Alunos</h3>',
//                    'type' => GridView::TYPE_PRIMARY,
//                ]
//            ]
//        ]);
//
//        kartik\widgets\ActiveForm::end();
//
//        //    $query = app\models\PerguntaAvaliacao::find()->where(['id_disciplina'=> $model->id]);
//        //    $query = app\models\PerguntaAvaliacao::find();
//        $query = app\models\Avaliacao::find()->where(['id_disciplina' => $model->id]);
//        $dataProvider = new yii\data\ActiveDataProvider([
//            'query' => $query,
//        ]);
//
//        //    $form = kartik\widgets\ActiveForm::begin(['action'=>Url::to(['pergunta-avaliacao/batchupdate','id'=>$model->id,'return'=>'disciplina'])]);
//        $form = kartik\widgets\ActiveForm::begin(['action' => Url::to(['avaliacao/update', 'id' => $model->id])]);
//
//        echo kartik\builder\TabularForm::widget([
//            'dataProvider' => $dataProvider,
//            'form' => $form,
//            'checkboxColumn' => false,
//            'actionColumn' => false,
//            'attributes' => [
//                'id' => [
//                    'type' => kartik\builder\TabularForm::INPUT_STATIC,
//                    'label' => 'id',
//                    'columnOptions' => ['hAlign' => GridView::ALIGN_RIGHT, 'width' => '90px']
//                ],
//                'nota' => [
//                    'type' => kartik\builder\TabularForm::INPUT_STATIC,
//                    'label' => 'nota',
//                    'columnOptions' => ['hAlign' => GridView::ALIGN_RIGHT, 'width' => '90px']
//                ],
//                'id_disciplina' => [
//                    'type' => kartik\builder\TabularForm::INPUT_STATIC,
//                    'label' => 'id_disciplina',
//                    'columnOptions' => ['hAlign' => GridView::ALIGN_RIGHT, 'width' => '90px']
//                ],
//            ],
//            'gridSettings' => [
//                'floatHeader' => true,
//                'panel' => [
//                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>Avaliacao</h3>',
//                    'type' => GridView::TYPE_PRIMARY,
//                ]
//            ]
//        ]);
//
//        kartik\widgets\ActiveForm::end();
//
//        $query = app\models\Questao::find()->where(['id_disciplina' => $model->id]);
//        $dataProvider = new yii\data\ActiveDataProvider([
//            'query' => $query,
//        ]);
//
//        $form = kartik\widgets\ActiveForm::begin(['action' => Url::to(['questao/batchupdate', 'id' => $model->id, 'return' => 'disciplina'])]);
//
//        echo kartik\builder\TabularForm::widget([
//            'dataProvider' => $dataProvider,
//            'form' => $form,
//            'checkboxColumn' => false,
//            'actionColumn' => false,
//            'attributes' => [
//                'id' => [
//                    'type' => kartik\builder\TabularForm::INPUT_STATIC,
//                    'label' => 'id',
//                    'columnOptions' => ['hAlign' => GridView::ALIGN_RIGHT, 'width' => '90px']
//                ],
//                'enunciado' => [
//                    'type' => kartik\builder\TabularForm::INPUT_STATIC,
//                    'label' => 'enunciado',
//                    'columnOptions' => ['hAlign' => GridView::ALIGN_RIGHT, 'width' => '90px']
//                ],
//                'id_disciplina' => [
//                    'type' => kartik\builder\TabularForm::INPUT_STATIC,
//                    'label' => 'id_disciplina',
//                    'columnOptions' => ['hAlign' => GridView::ALIGN_RIGHT, 'width' => '90px']
//                ],
//                'imagem' => [
//                    'type' => kartik\builder\TabularForm::INPUT_STATIC,
//                    'label' => 'imagem',
//                    'columnOptions' => ['hAlign' => GridView::ALIGN_RIGHT, 'width' => '90px']
//                ],
//            ],
//            'gridSettings' => [
//                'floatHeader' => true,
//                'panel' => [
//                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>Questao</h3>',
//                    'type' => GridView::TYPE_PRIMARY,
//                ]
//            ]
//        ]);
//
//        kartik\widgets\ActiveForm::end();
//
//        ?>
    </div>
</div>
