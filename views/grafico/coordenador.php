<?php

/* @var $this yii\web\View */

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = 'Gráfico Coordenador';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="avaliacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row bg-white">
        <div class="col-sm-12 p-2">
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group text-uppercase">
                        <label for="select_pergunta">Pergunta</label>
                        <select id="select_pergunta" class="form-control">
                            <option value="0">TODOS</option>
                            <?php foreach ($dataProvider as $pergunta) {
                                echo '<option class="form-control text-uppercase" value="' . $pergunta->id . '">' . strtoupper($pergunta->enunciado) . '</option>';
                            } ?>
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
                <div id="professorchart"></div>
            </div>
        </div>
    </div>
</div>
<script>
    let chart;

    function requestGraph() {
        let reqPergunta = typeof $("#select_pergunta") != 'undefined' && $("#select_pergunta") != null && $("#select_pergunta").val() != 0 ? `?pergunta=${$("#select_pergunta").val()}` : '';

        let norm = $('#switch_normalize').is(':checked')

        $.get(`<?= Url::to(['grafico/api-coordenador']) ?>${reqPergunta}`, result => {
            result = JSON.parse(result)
            result.label = result.labels.sort()
            if (chart) {
                chart.updateChart(result.series, result.labels, $("#select_pergunta option:selected").text(), result.matriculated, norm)
            } else {
                chart = new Chart('#professorchart', result.series, result.labels, $("#select_pergunta option:selected").text(), result.matriculated, norm);
            }
        })
    }

    window.onload = function () {
        requestGraph()

        $("#select_pergunta").on('change', () => requestGraph())

        $("#switch_normalize").on('change', () => requestGraph())


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
