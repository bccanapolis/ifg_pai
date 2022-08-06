<?php

/* @var $this yii\web\View */

use app\models\Aluno;
use app\models\DisciplinaMatriz;
use app\models\Professor;


$this->title = 'PAI';

$countAlunos = Aluno::find()->count();
$countProfessores = Professor::find()->count();
$countDisciplinas = DisciplinaMatriz::find()->count();
?>
<style>
    .shadow-boxes {
        padding: 20px;
        margin-left: 30px;
        margin-right: 30px;
        border-radius: 10px;
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
    }

    .text-color-theme {
        color: #d1705e !important;
    }

    .text-color-black {
        color: #000;
    }

    .img_bcc_hero {
        position: absolute;
        z-index: 1000;
        right: 0;
        margin: 20px;
    }

    @media (max-width: 700px) {
        .img_bcc_hero {
            width: 50%;
        }
    }
</style>
<section class="">
    <img src="<?= \yii\helpers\Url::to(['/site/images/hero.png']) ?>" alt="" style="width: 100%">
</section>
<section class="section">
    <div class="container section-inner">
        <div class="text-center" style="margin-bottom: 30px">
            <?php
            if (Yii::$app->user->isGuest) {
                ?>
                <a class="button button-primary"
                   href="<?= \yii\helpers\Url::to(['/site/login']) ?>"><i class="fa fa-lock"></i> &nbsp Login</a>
                <?php
            } else {
                ?>
                <a class="button button-secondary button-wide-mobile"
                   href="<?= \yii\helpers\Url::to(['/site/index']) ?>"><i class="fa fa-lock-open"></i> &nbsp Página
                    Admin</a>
                <?php
            }
            ?>
        </div>

        <h1 class="mt-0" style="color: #d1705e !important;">Processo de Avaliação Interno</h1>
        <p class="text-justify" style="color: #000">
            O Bacharelado em Ciência da Computação IFG - Anápolis entende como necessária a busca do autoconhecimento.
            Assim, por meio da cooperação de bons alunos: Bruno Araújo, Jeferson Marques, Pedro Henrique e Péterson
            Silva, temos hoje uma ferramenta que apresenta o desempenho dos discentes e docentes, respectivamente, na
            aquisição e na transmissão do conhecimento. Não temos dúvidas que essa ferramenta será fomentadora de um
            processo construtivo e de aperfeiçoamento do curso.
        </p>
    </div>
</section>
<section class="features-extended section">
    <div class="features-extended-inner section-inner">
        <div class="features-extended-wrap">
            <div class="container">
                <h3 class="mt-0 mb-16 text-center">Números do Curso...</h3>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-4 col-sm-4 col-xs-12 text-center " style="padding: 20px">
                        <div class="shadow-boxes">
                            <i class="fa fa-users fa-3x text-color-theme"></i>
                            <h3 class="text-color-black" style="font-weight: bold"><?= $countAlunos ?></h3>
                            <span class="text-color-black">Alunos</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 text-center" style="padding: 20px">
                        <div class="shadow-boxes">
                            <i class="fa fa-users fa-3x text-color-theme"></i>
                            <h3 class="text-color-black" style="font-weight: bold"><?= $countProfessores ?></h3>
                            <span class="text-color-black">Professores</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 text-center" style="padding: 20px">
                        <div class="shadow-boxes">
                            <i class="fa fa-users fa-3x text-color-theme"></i>
                            <h3 class="text-color-black" style="font-weight: bold"><?= $countDisciplinas ?></h3>
                            <span class="text-color-black">Disciplinas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="features-extended section">
    <div class="features-extended-inner section-inner">
        <div class="features-extended-wrap">
            <div class="container">
                <div class="feature-extended" id="qacoordenador">
                    <div class="feature-extended-image">
                        <div class="mockup-bg">
                            <div id="chart1"></div>

                        </div>
                    </div>
                    <div class="feature-extended-body is-revealing">
                        <h5 class="mt-0 mb-16 text-center">Questionário de Avaliação do Coordenador</h5>
                        <p class="m-0 text-justify">
                            O coordenador precisar ter ciência da opnião da comunidade do curso, em especial os
                            dicentes. Dessa forma o questionário proposto no PAI visa arguir de forma anônima as
                            respostas de vários desses, facilitando um processo contínuo de evolução e busca da
                            qualidade.
                        </p>
                    </div>
                </div>
                <div class="feature-extended" id="add">
                    <div class="feature-extended-image">
                        <div class="mockup-bg">
                            <div id="chart2"></div>
                        </div>
                    </div>
                    <div class="feature-extended-body is-revealing">
                        <h5 class="mt-0 mb-16 text-center">Avaliação Diagnóstica do Discente (ADD)</h5>
                        <p class="m-0 text-justify">
                            O objetivo dessa análise é avaliar se o aluno consegue ter boa aplicabilidade dos conteúdos
                            vistos, de forma independe às provas aplicadas em sala.
                        </p>
                    </div>
                </div>
                <div class="feature-extended" id="qac">
                    <div class="container-fluid">
                        <!--                        <div class="mockup-bg">-->
                        <?= \yii\helpers\Html::img(['site/images/image_form1.png'], ['class' => 'img-thumbnail', 'width' => '100% !important']) ?>
                        <!--                        </div>-->
                        <br><br>
                    </div>
                    <div class="feature-extended-body is-revealing">
                        <h5 class="mt-0 mb-16 text-center">Questionário de Avaliação do Curso (QAC)</h5>
                        <p class="m-0 text-justify">
                            A didática é perfeita quando construída com diálogo e flexibilidade. Assim, mantemos um
                            questionário que permite os discentes avaliarem o processo ensino-aprendizagem de todos os
                            docentes, considerando avaliações, planejamento de aulas e métodos de exposição.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var options = {
        chart: {
            type: 'bar',
            toolbar: {
                show: false,
            }
        },
        series: [{
            name: 'sales',
            data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
        }],
        xaxis: {
            categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
        },
        colors: ["#d1705e"],
    };

    var chart_main = new ApexCharts(document.querySelector("#chart-main"), options);
    chart_main.render();
    var chart1 = new ApexCharts(document.querySelector("#chart1"), options);
    chart1.render();
    var chart2 = new ApexCharts(document.querySelector("#chart2"), options);
    chart2.render();
    var chart3 = new ApexCharts(document.querySelector("#chart3"), options);
    chart3.render();
    var chart4 = new ApexCharts(document.querySelector("#chart4"), options);
    chart4.render();
</script>