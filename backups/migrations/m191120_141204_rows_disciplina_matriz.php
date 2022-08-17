<?php

use yii\db\Migration;

/**
 * Class m191120_141204_rows_disciplina_matriz
 */
class m191120_141204_rows_disciplina_matriz extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('disciplina_matriz', ['id', 'nome', 'sigla'],
            array([1, 'ALGEBRA LINEAR', 'ALLINEAR'],
            [2, 'ANALISE E PROJETO DE SOFTWARE', 'APS'],
            [3, 'ARQUITETURA E ORGANIZACAO DE COMPUTADORES I', 'AOC I'],
            [4, 'ARQUITETURA E ORGANIZACAO DE COMPUTADORES II', 'AOC II'],
            [5, 'BANCO DE DADOS I', 'BD I'],
            [6, 'BANCO DE DADOS II', 'BD II'],
            [7, 'CALCULO I', 'CAL I'],
            [8, 'CALCULO II', 'CAL II'],
            [9, 'COMPUTACAO GRAFICA', 'CG'],
            [10, 'CONSTRUCAO DE ALGORITMOS', 'CO'],
            [11, 'EDUCACAO DAS RELACOES ETNICO-RACIAIS E AFRODESCENDENCIA', 'RERA'],
            [12, 'ENGENHARIA DE SOFTWARE', 'ENSOF'],
            [13, 'ESTRUTURA DE DADOS I', 'ED I'],
            [14, 'ESTRUTURA DE DADOS II', 'ED II'],
            [15, 'ETICA, COMPUTADORES E SOCIEDADE', 'ECS'],
            [16, 'FISICA APLICADA A CIENCIA DA COMPUTACAO', 'FISCC'],
            [17, 'FUNDAMENTOS MATEMATICOS', 'FUMA'],
            [18, 'GERENCIA DE PROJETOS - TOPICOS ESPECIAIS EM COMPUTACAO I', 'GP'],
            [19, 'GRAMATICAS E COMPILADORES', 'GRC'],
            [20, 'INTELIGENCIA ARTIFICIAL', 'IA'],
            [21, 'INTERACAO HOMEM-MAQUINA', 'IHM'],
            [22, 'INTRODUCAO A CIENCIA DA COMPUTACAO', 'INCC'],
            [23, 'INTRODUCAO AOS SISTEMAS DIGITAIS', 'SIDI'],
            [24, 'IOT - TOPICOS ESPECIAIS EM COMPUTACAO II', 'IOT'],
            [25, 'LABORATORIO DE PROGRAMACAO', 'PROG'],
            [26, 'LOGICA E MATEMATICA DISCRETA', 'LMD'],
            [27, 'MATEMATICA COMPUTACIONAL', 'MC'],
            [28, 'METODOLOGIA DE PESQUISA CIENTIFICA', 'MPC'],
            [29, 'MINERACAO DE DADOS', 'MIDA'],
            [30, 'OTIMIZACAO DE SISTEMAS', 'OSIS'],
            [31, 'PARADIGMAS DE PROGRAMACAO', 'PP'],
            [32, 'PROBABILDADE E ESTATISTICA', 'PRES'],
            [33, 'PROCESSAMENTO DIGITAL DE IMAGENS', 'PDI'],
            [34, 'PROGRAMACAO DE DISPOSITIVOS MOVEIS', 'PRMOV'],
            [35, 'PROGRAMACAO ORIENTADA A OBJETOS', 'POO'],
            [36, 'PROGRAMACAO WEB', 'PW'],
            [37, 'PROJETO AVANCADO DE ALGORITMOS', 'PAA'],
            [38, 'REDES DE COMPUTADORES', 'RC'],
            [39, 'SISTEMAS DISTRIBUIDOS', 'SDIS'],
            [40, 'SISTEMAS OPERACIONAIS', 'SIOP'],
            [41, 'TEORIA DA COMPUTACAO', 'TEOC'],
            [42, 'TEORIA DOS GRAFOS', 'TEGRA'],
            [43, 'TRABALHO DE CONCLUSAO DE CURSO I', 'TCC I'],
            [44, 'TRABALHO DE CONCLUSAO DE CURSO II', 'TCC II'],
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191120_141204_rows_disciplina_matriz cannot be reverted.\n";

        return false;
    }
    */
}
