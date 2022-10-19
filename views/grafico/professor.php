<?php

/* @var $this yii\web\View */

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = 'Gráfico Professor';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="card">

    <div class="row no-gutters">
        <div class="col-sm-12">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group text-uppercase">
                            <label for="select_professor">PROFESSOR</label>
                            <select id="select_professor" class="form-control">
                                <option value="0" change="atualizaGrafico()">TODOS</option>
                                <?php foreach ($dataProvider as $professor) {
                                    echo '<option class="form-control text-uppercase" value="' . $professor['id'] . '">' . strtoupper($professor['nome']) . '</option>';
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 <?php
                    $user = \app\models\User::find()->where(['id' => Yii::$app->user->id])->one();
                    if (isset($user) && $user->aluno) {
                        echo "hidden";
                    }
                    ?>">
                        <div class="form-group">
                            <label for="select_disciplina">DISCIPLINA</label>
                            <select id="select_disciplina" change="atualizaGrafico()" disabled class="form-control">
                                <option value="0">TODOS</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row <?php
                $user = \app\models\User::find()->where(['id' => Yii::$app->user->id])->one();
                if (isset($user) && $user->aluno) {
                    echo "hidden";
                }
                ?>">
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label for="select_question">PERGUNTA</label>
                            <select id="select_question" change="atualizaGrafico()" disabled class="form-control">
                                <option value="0">TODOS</option>
                                <?php
                                $perguntas = \app\models\QacProfessorPergunta::find()->all();
                                foreach ($perguntas as &$value) {
                                    echo '<option value="' . $value->id . '">' . $value->enunciado . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <p class="switch-text">REAL / RELATIVO</p>
                            <label class="switch">
                                <input id="switch_normalize" type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <div id="professorchart" class="container-chart"></div>
                    <div class="container-loader">
                        <div class="loading"><i></i><i></i><i></i><i></i></div>
                    </div>
                    <p id="description_disciplina" style="text-align: center; display: none;">Esse gráfico apresenta a
                        distribuição da quantidade de avaliações ótimo, bom, regular, ruim e péssimo para todas as 10
                        perguntas aplicadas.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let chart

    function eaLoader(flag) {
        if (flag) {
            $(".container-loader").show().css('opacity', '1');
            $(".container-chart").css('opacity', '0').hide();
        } else {
            $(".container-loader").css('opacity', '0').hide();
            $(".container-chart").show().css('opacity', '1');

        }
    }

    function requestGraph() {
        eaLoader(true)
        // $("#professorchart").empty();

        let reqProf = typeof $("#select_professor") != 'undefined' && $("#select_professor") != null && $("#select_professor").val() != 0 ? `?professor=${$("#select_professor").val()}` : '';
        let reqDisc = typeof $("#select_disciplina") != 'undefined' && $("#select_disciplina") != null && $("#select_disciplina").val() != 0 ? `&disciplina=${$("#select_disciplina").val()}` : '';
        let reqPerg = typeof $("#select_question") != 'undefined' && $("#select_question") != null && $("#select_question").val() != 0 ? `&pergunta=${$("#select_question").val()}` : '';

        let norm = $('#switch_normalize').is(':checked')

        $.get(`<?= Url::to(['grafico/api-professor']) ?>${reqProf}${reqDisc}${reqPerg}`, result => {
            result = JSON.parse(result)
            result.label = result.label.sort()

            if (!chart) {
                chart = new Chart('#professorchart', result.series, result.label, result.title, result.matriculated, norm);
            } else {
                chart.updateChart(result.series, result.label, result.title, result.matriculated, norm)
            }

            eaLoader(false)
        })
    }

    window.onload = function () {

        $('#switch_normalize').on('change', () => requestGraph())

        $('#select_professor').on('change', () => {
            if ($('#select_professor').val() == 0) {
                $('#select_disciplina').empty();
                $('#select_disciplina').append($('<option></option>').val(0).text('TODOS'));
                $('#select_disciplina').attr('disabled', true)

                $('#select_question').val(0).change();
                $('#select_question').attr('disabled', true)
            } else {
                $.get('<?= Url::to(['grafico/disciplina']) ?>?professor=' + $('#select_professor').val(), result => {
                    result = JSON.parse(result)
                    $('#select_disciplina').empty();
                    $('#select_disciplina').append($('<option></option>').val(0).text('TODOS'));
                    $('#select_disciplina').attr('disabled', false)
                    result.disciplinas.forEach(item => {
                        let option = $('<option></option>');
                        option.val(item.id);
                        option.text(item.nome);
                        $('#select_disciplina').append(option);

                    });

                    $('#select_question').val(0).change();
                    $('#select_question').attr('disabled', false)
                })
            }
        })

        requestGraph()

        $("#select_disciplina").on('change', () => {
            if ($('#select_disciplina').val() == 0) {
                $('#select_question').val(0).change();
                $('#select_question').attr('disabled', false)
            } else {
                $('#select_question').val(0).change();
                $('#select_question').attr('disabled', false)
            }
        })

        $("#select_question").on('change', () => {
            if ($("#select_question").val() == 0 && $('#select_disciplina').val() != 0) $("#description_disciplina").show()
            else $("#description_disciplina").hide()
            requestGraph()
        })
    }
</script>
<?php
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});


";
$this->registerJs($search);
$this->registerJsFile("@web/js/charts.js");
?>
