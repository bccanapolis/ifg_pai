<?php

use yii\helpers\Url;
use app\extensions\AmpleNav;

?>
<style>
    @media screen and (max-width: 780px) {
        #div-up-menu {
            margin-top: 70px;
        }
    }
</style>
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<div class="navbar navbar-dark bg-dark sidebar" role="navigation">
    <div class="sidebar-nav navbar-dark bg-dark slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span
                        class="hide-menu">PAI</span>
            </h3>
        </div>

        <div id="div-up-menu">
            <?= AmpleNav::widget([
                "items" => [
                    [
                        "label" => "Dashboard",
                        "icon" => "fa-tachometer-alt",
                        "url" => ['/site/index'],
                    ],
                    [
                        "label" => "Perfil",
                        "icon" => "fa-user",
                        "url" => ['/site/view-profile'],
                    ],
                    [
                        "label" => "Aluno",
                        "icon" => "fa-graduation-cap",
                        "url" => ['/aluno/index'],
                    ],
                    [
                        "label" => "Professor",
                        "icon" => "fa-address-card",
                        "url" => ['/professor/index'],
                    ],
                    [
                        "label" => "Disciplina Grade",
                        "icon" => "fa-address-card",
                        "url" => ['/disciplina-matriz/index'],
                    ],
                    [
                        "label" => "Disciplina",
                        "icon" => "fa-address-card",
                        "url" => ['/disciplina/index'],
                    ],
                    [
                        "label" => "Alunos Disciplina",
                        "icon" => "fa-address-card",
                        "url" => ['/aluno-disciplina/index'],
                    ],
                    [
                        "label" => "Perguntas do ADD",
                        "icon" => "fa-address-card",
                        "url" => ['/questao/index'],
                    ],
                    [
                        "label" => "Perguntas da Avaliação",
                        "icon" => "fa-address-card",
                        "url" => ['/pergunta-avaliacao/index'],
                    ],
                    [
                        "label" => "ADD - Avaliação Diagnóstica do Discente",
                        "icon" => "fa-address-card",
                        "url" => ['/questionario/listar-perguntas'],
                    ],
                    [
                        "label" => "QAC - Questionário de Avaliação do Curso",
                        "icon" => "fa-address-card",
                        "url" => ['/avaliacao/create'],
                    ],
                    [
                        "label" => "Perguntas Questionário do Coordenador",
                        "icon" => "fa-address-card",
                        "url" => ['/pergunta-avaliacao-coordenador/index'],
                    ],
                    [
                        "label" => "QACoordenador",
                        "icon" => "fa-address-card",
                        "url" => ['/avaliacao-coordenador/create'],
                    ],
                    [
                        "label" => "Gráficos",
                        "icon" => "fa-chart-pie",
                        "url" => ['/grafico/index'],
                    ],
                    [
                        "label" => "Notas",
                        "icon" => "fa-file",
                        "url" => ['/notas/normalizacao'],
                    ],

                    [
                        "label" => "Comentários Avaliação do Coordenador",
                        "icon" => "fa-address-card",
                        "url" => ['/comentario-avaliacao-coordenador/index'],
                    ],
                    [
                        "label" => "Comentários Avaliação Disciplinas",
                        "icon" => "fa-address-card",
                        "url" => ['/comentario-avaliacao/index'],
                    ],
                    [
                        "label" => "Selecionar Disciplina para Nota",
                        "icon" => "fa-file",
                        "url" => ['/notas-disciplina/create'],
                    ],
                ],
            ]);
            ?>
        </div>
        <!--        <ul class="nav" id="side-menu">-->
        <!--            <li>-->
        <!--                <a href="--><? //= Url::to(['/aluno/index']) ?><!--" class="waves-effect">-->
        <!--                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>Aluno-->
        <!--                </a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a href="--><? //= Url::to(['/professor/index']) ?><!--" class="waves-effect">-->
        <!--                    <i class="fa fa-address-card" aria-hidden="true"></i>Professor</a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a href="--><? //= Url::to(['/disciplina/index']) ?><!--" class="waves-effect">-->
        <!--                    <i class="fa fa-book" aria-hidden="true"></i>Disciplina</a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a href="--><? //= Url::to(['/aluno-disciplina/index']) ?><!--" class="waves-effect">-->
        <!--                    <i class="fa fa-pie-chart" aria-hidden="true"></i>Aluno-Disciplina-->
        <!--                </a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a href="--><? //= Url::to(['/questao/index']) ?><!--" class="waves-effect">-->
        <!--                    <i class="fa fa-pie-chart" aria-hidden="true"></i>Perguntas do Questionário-->
        <!--                </a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a href="--><? //= Url::to(['/pergunta-avaliacao/index']) ?><!--" class="waves-effect">-->
        <!--                    <i class="fa fa-pie-chart" aria-hidden="true"></i>Perguntas da Avaliação-->
        <!--                </a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a href="-->
        <? //= Url::to(['/questionario/listar-perguntas']) ?><!--" class="waves-effect">-->
        <!--                    <i class="fa fa-pie-chart" aria-hidden="true"></i>ADD - Avaliação Diagnóstica do Discente-->
        <!--                </a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a href="--><? //= Url::to(['/avaliacao/create']) ?><!--" class="waves-effect">-->
        <!--                    <i class="fa fa-pie-chart" aria-hidden="true"></i>QAC - Questionário de Avaliação do Curso-->
        <!--                </a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a href="-->
        <? //= Url::to(['/pergunta-avaliacao-coordenador/index']) ?><!--" class="waves-effect">-->
        <!--                    <i class="fa fa-pie-chart" aria-hidden="true"></i>Perguntas Questionário do Coordenador-->
        <!--                </a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a href="-->
        <? //= Url::to(['/avaliacao-coordenador/create']) ?><!--" class="waves-effect">-->
        <!--                    <i class="fa fa-pie-chart" aria-hidden="true"></i>QACoordenador-->
        <!--                </a>-->
        <!--            </li>-->
        <!--        </ul>-->
    </div>

</div>
<!-- ============================================================== -->
<!-- End Left Sidebar -->
<!-- ============================================================== -->
