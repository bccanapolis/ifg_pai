<?php

/* @var $this yii\web\View */

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = 'Gráfico Disciplina';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="avaliacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row bg-white">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <select id="select_professor" class="form-control">
                            <?php foreach ($dataProvider->professor as $disciplina) {
                                echo '<option class="form-control" value="' . $disciplina['id'] . '">' . $disciplina['nome'] . '</option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <select id="select_disciplina" class="form-control">
                            <?php foreach ($dataProvider->disciplinas as $disciplina) {
                                echo '<option class="form-control" value="' . $disciplina['id'] . '">' . $disciplina['nome'] . '</option>';
                            } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div id="disciplinachart"></div>
            </div>
        </div>
    </div>

</div>
<?php
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});

class Chartbar {
    constructor(id, series, labels, options) {
        this.series = this.sanitize(series, labels);
        this.labels = labels;
        this.id = id;
        this.options = this.defaultOptions(options) 
        this.chart = new ApexCharts(document.querySelector(id), this.options);
        this.chart.render()
    }
    defaultOptions(options){
        return Object.assign({
            chart: {
                height: 350,
                type: 'line',
                shadow: {
                    enabled: true,
                    color: '#000',
                    top: 18,
                    left: 7,
                    blur: 10,
                    opacity: 1
                },
                toolbar: {
                    show: false
                }
            },
//            colors: ['#77B6EA', '#545454'],
            dataLabels: {
                enabled: true,
            },
            stroke: {
                curve: 'smooth'
            },
            series: [{},{}],
            title: {
                text: this.labels,
                align: 'left'
            },
            grid: {
                borderColor: '#e7e7e7',
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            markers: {
                size: 6
            },
            xaxis: {
                categories: this.labels,
//                title: {
//                    text: 'Month'
//                }
            },
            yaxis: {
                title: {
                    text: 'Votos'
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                floating: true,
                offsetY: -25,
                offsetX: -5
            }
        }, options)
    }
    updateChart(series, labels){
        this.chart.updateOptions({
            xaxis: {
                categories: labels
            }
        })
        this.chart.updateSeries(this.sanitize(series))
    }
    sanitize(series, labels){
        let total = {'Ótimo': {name: 'Ótimo', data: []},
        'Bom': {name: 'Bom', data: []},
        'Regular': {name: 'Regular', data: []},
        'Ruim': {name: 'Ruim', data: []},
        'Péssimo': {name: 'Péssimo', data: []}}
        
        series.forEach((item, index) => {
            total[item.nota] = {name: item.nota, data: [item.count]}
        })
        
        let final = []
        for(let item in total){
            final.push(total[item])
        }
       
        return final
    }
}


let chart;

$.get('" . Url::to(['grafico/disciplina']) . "?id='+$('#select_disciplina').val(), result => {
    result = JSON.parse(result)
    chart = new Chartbar('#disciplinachart', result.series, result.labels);
})


$('#select_disciplina').on('change',() => {
    $.get('" . Url::to(['grafico/disciplina']) . "?id='+$('#select_disciplina').val(), result => {
        result = JSON.parse(result)
        chart.updateChart(result.series, result.labels);
    })
})
";
$this->registerJs($search);
?>
