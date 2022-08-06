<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Avaliacao */
/* @var $disciplinas app\models\Disciplina[] */

$this->title = 'Avaliação Disciplinas';
$this->params['breadcrumbs'][] = ['label' => 'Avaliacao', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="avaliacao-create">

    <h1><?= ''//Html::encode($this->title)    ?></h1>

    <?php
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        if (is_array($message) and isset($message[0])) {
            echo '<div class="alert alert-', $key . '">' . $message[0] . "</div>\n";
        } elseif (is_string($message)) {
            echo '<div class="alert alert-', $key . '">' . $message . "</div>\n";
        }
    }
    ?>

    <div class="avaliacao-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'id_disciplina')->widget(\kartik\widgets\Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map($disciplinas, 'id', \app\models\Disciplina::representingColumn()),
            'options' => ['placeholder' => 'Escolha a Disciplina'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <?php
        /**
         * @var \app\models\PerguntaAvaliacao $pergunta
         */
        foreach (\app\models\PerguntaAvaliacao::find()->all() as $index => $pergunta) {
            ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <?= "<b>" . ($index + 1) . ") " . ucfirst($pergunta->enunciado) . "</b><br>" ?>
                    <?= $form->field($model, "[{$index}]id_pergunta_avaliacao", ['template' => '{input}'])->textInput(['style' => 'display:none', 'value' => $pergunta->id]); ?>
                    <?= ''//$form->field($model, "[{$index}]nota")->radioList(\app\models\Avaliacao::getNotas())->label(false)   ?>

                    <?=
                    $form->field($model, "[{$index}]nota")->inline(false)
                        ->radioList(
                            \app\models\Avaliacao::getNotas(),
                            [
                                'item' => function ($index, $label, $name, $checked, $value) {

                                    $return = '<label class="modal-radio">';
                                    $return .= '<input type="radio" ';
                                    if ($checked) {
                                        $return .= 'checked';
                                    }
                                    $return .= ' name="' . $name . '" value="' . $value . '" tabindex="3">';
                                    $return .= '<i></i>';
                                    $return .= '<span>' . ucwords(' ' . $label) . '</span>';
                                    $return .= '</label>';
                                    $return .= '<br>';
                                    return $return;
                                }
                            ]
                        )
                        ->label(false);
                    ?>
                </div>
            </div>
            <?php
        }
        ?>

        <?php
        $modelComentario = new \app\models\ComentarioAvaliacao();
//        $form2 = \yii\widgets\ActiveForm::begin([
//            'enableClientValidation' => false,
//        ]); ?>
        <?= $form->field($modelComentario, 'texto')->textarea(['rows' => 5]) ?>
<!--        --><?php //\yii\widgets\ActiveForm::end(); ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Avaliar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>