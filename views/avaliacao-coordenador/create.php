<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoCoordenador */
/* @var $disciplinas app\models\Disciplina[] */

$this->title = 'Avaliação Coordenador';
$this->params['breadcrumbs'][] = ['label' => 'Avaliação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
    <div class="avaliacao-create">

        <div class="avaliacao-form">

            <?php $form = ActiveForm::begin(); ?>


            <?php
            /**
             * @var \app\models\PerguntaAvaliacao $pergunta
             */
            foreach (\app\models\PerguntaAvaliacaoCoordenador::find()->all() as $index => $pergunta) {
                ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?= "<b>" . ($index + 1) . ") " . ucfirst($pergunta->enunciado) . "</b><br>" ?>
                        <?= $form->field($model, "[{$index}]id_pergunta_avaliacao_coordenador", ['template' => '{input}'])->textInput(['style' => 'display:none', 'value' => $pergunta->id]); ?>
                        <?= ''//$form->field($model, "[{$index}]nota")->radioList(\app\models\Avaliacao::getNotas())->label(false)  ?>

                        <?=
                        $form->field($model, "[{$index}]nota")->inline(false)
                            ->radioList(
                                \app\models\AvaliacaoCoordenador::getNotas(),
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
            $modelComentario = new \app\models\ComentarioAvaliacaoCoordenador();
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
<?php

echo \kartik\dialog\Dialog::widget([
    'options' => [
        'type' => \kartik\dialog\Dialog::TYPE_SUCCESS, // bootstrap contextual color
        'title' => 'Avaliação do Coordenador',
    ], // default options
]);
$js = "
$(document).ready(function () {
    krajeeDialog.alert('Caros alunos e alunas, <br> O curso de Bacharelado em Ciência da Computação IFG - Anápolis os convida para avaliar o trabalho do Coordenador do Curso. O objetivo dessa análise é servir como um facilitador para um processo contínuo de evolução e busca da qualidade. <br> Essa avaliação é de muita importância, por favor, marquem as opções com atenção. <br> Embora vocês tenham efetuado o login, é MUITO importante ressaltar que todas as respostas são armazenadas de maneira anônima. Não há nenhum registro de quem respondeu o quê. Assim, peço que as respostas sejam coerentes e sinceras. <br> Não custa avisar, mas cada aluno pode submeter as respostas apenas uma ÚNICA vez. <br><br> Atenciosamente, <br> Coordenação de Curso.')
})
";
$this->registerJs($js);
?>