<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $perguntas app\models\Questao[] */
/* @var $pergunta app\models\Questao */

$this->title = 'Respostas Questionários';
$this->params['breadcrumbs'][] = ['label' => 'Resposta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
if (isset($perguntas[$active])) {
    $pergunta = $perguntas[$active];
} else {
    $pergunta = $perguntas[0];
}
//var_dump($respostas);
?>
    <style>
        a.btn.btn-default.active {
            background: #2f323e !important;
            color: #fff;
        }

        #resposta-id_alternativa > label {
            font-weight: normal !important;
        }

        .respondida {
            background: orange !important;
        }
    </style>
    <div class="resposta-create">

        <div class="btn-group" role="group">
            <?php
            foreach ($perguntas as $index => $value) {
                $indexShow = $index + 1;
                $respondida_bool = (in_array($value->id, array_column($respostas, 'id_questao_respondida')));
                echo "<a href=" . \yii\helpers\Url::to(['questionario/listar-perguntas', 'active' => $index]) . " class='btn btn-default bg-white " . ($respondida_bool && $active != $index ? 'respondida' : '') . (($active == $index) ? "active" : "") . "'>{$indexShow}</a>";
            }
            ?>
        </div>
        <br><br>

        <div class="bg-white" style="padding: 20px">
            <p class="text-right">
                Máteria relacionada: <b><?= $pergunta->disciplina->nome ?></b>
            </p>

            <div class="text-center" style="margin-top: 15px; margin-bottom: 15px">

                <div class="" style="padding: 10px;">
                    <?php
                    if (!is_null($pergunta->enunciado) && $pergunta->enunciado != "") {
                        echo "<p>" . ucfirst($pergunta->enunciado) . "</p>";
                    }
                    ?>
                </div>

                <?php if (!is_null($pergunta->imagem) && $pergunta->enunciado != "") {
                    echo "<br>" . Html::img([$pergunta->imagem], ['class' => 'img-thumbnail']) . "<br><br>";
                } ?>
            </div>

            <div class="questao-form">

                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'id' => 'dynamic-form']); ?>

                <div class="input-wrap">
                    <div class="clearfix" id="respota-id_alternativa">
                        <hr>
                        <label class="radio-head">Alternativas:</label>
                        <br><br>
                        <?=
                        $form->field($model, 'id_alternativa')->inline(false)
                            ->radioList(
                                \yii\helpers\ArrayHelper::map($pergunta->alternativas, 'id', 'descricao'),
                                [
                                    'item' => function ($index, $label, $name, $checked, $value) {

                                        $return = '<label class="">';
                                        $return .= '<input type="radio" class="custom-control-input"';
                                        if ($checked) {
                                            $return .= 'checked';
                                        }
                                        $return .= ' name="' . $name . '" value="' . $value . '">';
//                                $return .= '<i></i>';
                                        $return .= ucwords(' ' . $label);
                                        $return .= '</label>';
                                        $return .= '<br>';
                                        return $return;
                                    }
                                ]
                            )
                            ->label(false);
                        ?>
                    </div>
                    <div class="help-block"></div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton(($index != $active) ? 'Próxima' : 'Finalizar', ['class' => ($index != $active) ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
<?php

echo \kartik\dialog\Dialog::widget([
    'options' => [
        'type' => \kartik\dialog\Dialog::TYPE_SUCCESS, // bootstrap contextual color
        'title' => 'Avaliação Diagnóstica do Discente',
    ], // default options
]);
if ($active == 0) {
    $js = "
$(document).ready(function () {
    krajeeDialog.alert('Caros alunos e alunas, <br><br> O curso de Bacharelado em Ciência da Computação os convida para fazer a Avaliação Diagnóstica do Discente. O objetivo dessa análise é avaliar se o aluno consegue ter boa aplicabilidade dos conteúdos vistos, de forma independe às provas aplicadas em sala. O resultado dessa avaliação pode te ajudar com até 0.5 décimos em alguma disciplina no semestre. <br> Essa avaliação é de muita importância, por favor, marquem as opções com atenção. Não custa avisar, mas cada aluno pode submeter as respostas apenas uma ÚNICA vez. <br><br> Atenciosamente, <br> Coordenação de Curso.')
})
";
    $this->registerJs($js);
}
?>