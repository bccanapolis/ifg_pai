class Chart {
    constructor(id, series, labels, title, matriculated, normalized = true, options) {
        this.labels = labels;
        this.title = title;
        this.series = series;
        this.normalized = normalized;
        this.matriculated = matriculated;
        this.updateSeriesName();
        this.series = this.sanitize(this.series, this.labels);
        this.id = id;
        this.options = this.defaultOptions(options)
        this.chart = new ApexCharts(document.querySelector(id), this.options);
        this.chart.render()
    }

    updateSeriesName() {
        this.labels = Object.values(this.matriculated).map(item => {
            if (['2018-2', '2019-1'].includes(item['ano_semestre'])) {
                return `${item['ano_semestre']} (*)`
            }
            return `${item.ano_semestre} (${item.alunos_responderam})`
        }).sort()

        this.series = this.series.map(item => {
            let ano_semestre = ""
            if (['2018-2', '2019-1'].includes(item['ano_semestre'])) {
                ano_semestre =
                    `${item['ano_semestre']} (*)`
            } else {
                ano_semestre =
                    `${this.matriculated[item['ano_semestre']]['ano_semestre']} (${this.matriculated[item['ano_semestre']]['alunos_responderam']})`
            }
            return {
                ...item,
                ano_semestre
            }
        })
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
                    formatter: (val) => this.normalized ?
                        `${val}%`
                        :
                        `${val}`

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
                //                }
            },
            yaxis: {
                title: {
                    text: 'Alunos'
                },
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


    updateChart(series, labels, title, matriculated, normalized) {
        this.title = title;
        this.series = series;
        this.labels = labels;
        this.matriculated = matriculated;
        this.updateSeriesName();
        this.normalized = normalized;

        this.chart.updateOptions({
            chart: {
                type: this.labels.length > 1 ? 'line' : 'bar'
            },
            xaxis: {
                categories: this.labels
            },
            title: {
                text: this.title,
                align: 'left'
            },
        })

        this.chart.updateSeries(this.sanitize(this.series, this.labels))
    }

    sanitize(series, labels) {
        let total = {
            'Ótimo': {name: 'Ótimo', data: new Array(labels.length).fill(0)},
            'Bom': {name: 'Bom', data: new Array(labels.length).fill(0)},
            'Regular': {name: 'Regular', data: new Array(labels.length).fill(0)},
            'Ruim': {name: 'Ruim', data: new Array(labels.length).fill(0)},
            'Péssimo': {name: 'Péssimo', data: new Array(labels.length).fill(0)}
        }

        series.forEach((item, index) => {
            total[item.nota].data[labels.lastIndexOf(item.ano_semestre)] = item.count
        })

        let final = []
        for (let item in total) {
            final.push(total[item])
        }
        if (this.normalized) {
            final = this.normalizeData(final)
        }
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