<?php

/* @var $this yii\web\View */

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = 'Gráfico ADD';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="avaliacao-index">

    <div class="row bg-white" style="padding-bottom: 20px;">
        <div class="col-sm-12 p-20">
            <!--            <div class="row">-->
            <!--                <div class="col-sm-6">-->
            <!--                    <div class="form-group text-uppercase">-->
            <!--                        <label for="select_professor">PROFESSOR</label>-->
            <!--                        <select id="select_professor" class="form-control">-->
            <!--                            <option value="0" change="atualizaGrafico()">TODOS</option>-->
            <!--                            --><?php //foreach ($dataProvider as $professor) {
            //                                echo '<option class="form-control text-uppercase" value="' . $professor['id'] . '">' . strtoupper($professor['nome']) . '</option>';
            //                            } ?>
            <!--                        </select>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!---->
            <!--                <div class="col-sm-6 --><?php
            //                $user = \app\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
            //                if (isset($user) && $user->aluno) {
            //                    echo "hidden";
            //                }
            //                ?><!--">-->
            <!--                    <div class="form-group">-->
            <!--                        <label for="select_professor">DISCIPLINA</label>-->
            <!--                        <select id="select_disciplina" change="atualizaGrafico()" disabled class="form-control">-->
            <!--                            <option value="0">TODOS</option>-->
            <!--                        </select>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->

            <div class="form-group">
                <div id="professorchart" class="container-chart"></div>
                <div class="container-loader">
                    <div class="loading"><i></i><i></i><i></i><i></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let chart;

    function eaLoader(flag) {
        if (flag) {
            $(".container-loader").show().css('opacity', '1');
            $(".container-chart").css('opacity', '0').hide();
        } else {
            $(".container-loader").css('opacity', '0').hide();
            $(".container-chart").show().css('opacity', '1');

        }
    }

    window.onload = function () {
        eaLoader(true)
        $.get(`<?= Url::to(['grafico/api-add']) ?>`, result => {
            result = JSON.parse(result)
            // result.label = result.label.sort()
            chart = new Chart('#professorchart', result.series, result.label, 'Avaliação Diagnostico Discente');
            eaLoader(false)
        })
    }


    class Chart {
        constructor(id, series, labels, title, options) {
            this.labels = labels;
            this.title = title;
            this.series = this.sanitize(series, labels);
            this.id = id;
            this.options = this.defaultOptions(options)
            this.chart = new ApexCharts(document.querySelector(id), this.options);
            this.chart.render()
        }

        defaultOptions(options) {
            return Object.assign({
                chart: {
                    height: 350,
                    type: this.labels.length > 1 ? 'line' : 'bar',
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
                tooltip: {
                    enabled: true,
                    y: {
                        formatter: function (val) {
                            return `${val}%`;
                        }
                    },
                },
                dataLabels: {
                    enabled: true,
                },
                stroke: {
                    curve: 'smooth'
                },
                series: this.series,
                title: {
                    text: this.title,
                    align: 'left'
                },
                // grid: {
                //     borderColor: '#e7e7e7',
                //     row: {
                //         colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                //         opacity: 0.5
                //     },
                // },
                markers: {
                    size: 6
                },
                xaxis: {
                    categories: this.labels,
//                title: {
//                    text: 'Month'
//                },
                },
                yaxis: {
                    title: {
                        text: 'Media Acertos'
                    },
                    labels: {
                        formatter: function (value) {
                            return `${value}%`;
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    floating: true,
                    // offsetY: -25,
                    // offsetX: -5
                }
            }, options)
        }


        updateChart(series, labels) {
            this.chart.updateOptions({
                chart: {
                    type: labels.length > 1 ? 'line' : 'bar'
                },
                xaxis: {
                    categories: labels
                }
            })

            this.chart.updateSeries(this.sanitize(series, labels))
        }

        sanitize(series, labels) {
            let total = {
                '8': {name: '8º periodo', data: new Array(labels.length).fill(0)},
                '6': {name: '6º periodo', data: new Array(labels.length).fill(0)},
                '4': {name: '4º periodo', data: new Array(labels.length).fill(0)},
                '2': {name: '2º periodo', data: new Array(labels.length).fill(0)},
            }

            series.forEach((item, index) => {
                total[item.periodo].data[labels.lastIndexOf(item.ano_semestre)] = item.count
            })

            let final = []
            for (let item in total) {
                final.push(total[item])
            }
            // final = this.normalizeData(final)
            return final
        }

        normalizeData(series) {
            for (let i = 0; i < series[0].data.length; i++) {
                let sum = 0
                series.forEach(item => {
                    sum += item.data[i]
                });
                for (let j = 0; j < series.length; j++) {
                    series[j]['data'][i] = Math.round((series[j]['data'][i] / sum * 100) * 10) / 10
                }
            }
            return series
        }
    }
</script>
<?php
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});


";
$this->registerJs($search);
?>
