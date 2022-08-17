<?php

use yii\db\Migration;

/**
 * Class m190214_174056_insert_auth_item_child
 */
class m191113_161651_insert_auth_item_child extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('auth_item_child', ['parent', 'child'], [
            //ALUNOS
            ["responder-questao-add","/questionario/listar-perguntas"],
            ["responder-questao-qac","/avaliacao/create"],
            ["responder-questao-qacoordenador","/avaliacao-coordenador/create"],

            ["aluno","responder-questao-add"],
            ["aluno","responder-questao-qac"],
            ["aluno","responder-questao-qacoordenador"],

            //PROFESSORES
            ["add-questao-add","/questao/*"],
            ["add-disciplina","/disciplina/*"],
            ["add-aluno-disciplina","/aluno-disciplina/*"],

            ["professor","add-questao-add"],
            //["professor","add-disciplina"],
            //["professor","add-aluno-disciplina"],

            //COORDENADOR
            ["add-professor","/professor/*"],
            ["add-questao-qacoordenador","/pergunta-avaliacao-coordenador/*"],
            ["add-questao-qac","/pergunta-avaliacao/*"],

            ["coordenador","add-professor"],
            ["coordenador","add-questao-qacoordenador"],
            ["coordenador","add-questao-qac"],

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        $this->delete('auth_item_child');
    }
}
