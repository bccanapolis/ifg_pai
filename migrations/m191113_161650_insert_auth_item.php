<?php

use yii\db\Migration;

/**
 * Class m190214_174051_insert_auth_item
 */
class m191113_161650_insert_auth_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["/site/index","3",null,null,null,"1550612439","1550612439",null],
            ["/aluno/*","3",null,null,null,"1550612439","1550612439",null],
            ["/aluno/create","3",null,null,null,"1550612439","1550612439",null],
            ["/aluno/update","3",null,null,null,"1550612439","1550612439",null],
            ["/aluno/delete","3",null,null,null,"1550612439","1550612439",null],
            ["/aluno/view","3",null,null,null,"1550612439","1550612439",null],
            ["/aluno/index","3",null,null,null,"1550612439","1550612439",null],
            ["/professor/*","3",null,null,null,"1550612439","1550612439",null],
            ["/professor/create","3",null,null,null,"1550612439","1550612439",null],
            ["/professor/update","3",null,null,null,"1550612439","1550612439",null],
            ["/professor/delete","3",null,null,null,"1550612439","1550612439",null],
            ["/professor/view","3",null,null,null,"1550612439","1550612439",null],
            ["/professor/index","3",null,null,null,"1550612439","1550612439",null],
            ["/disciplina/*","3",null,null,null,"1550612439","1550612439",null],
            ["/disciplina/create","3",null,null,null,"1550612439","1550612439",null],
            ["/disciplina/update","3",null,null,null,"1550612439","1550612439",null],
            ["/disciplina/delete","3",null,null,null,"1550612439","1550612439",null],
            ["/disciplina/view","3",null,null,null,"1550612439","1550612439",null],
            ["/disciplina/index","3",null,null,null,"1550612439","1550612439",null],
            ["/aluno-disciplina/*","3",null,null,null,"1550612439","1550612439",null],
            ["/aluno-disciplina/create","3",null,null,null,"1550612439","1550612439",null],
            ["/aluno-disciplina/update","3",null,null,null,"1550612439","1550612439",null],
            ["/aluno-disciplina/delete","3",null,null,null,"1550612439","1550612439",null],
            ["/aluno-disciplina/view","3",null,null,null,"1550612439","1550612439",null],
            ["/aluno-disciplina/index","3",null,null,null,"1550612439","1550612439",null],
            ["/questao/*","3",null,null,null,"1550612439","1550612439",null],
            ["/questao/create","3",null,null,null,"1550612439","1550612439",null],
            ["/questao/create2","3",null,null,null,"1550612439","1550612439",null],
            ["/questao/update","3",null,null,null,"1550612439","1550612439",null],
            ["/questao/delete","3",null,null,null,"1550612439","1550612439",null],
            ["/questao/view","3",null,null,null,"1550612439","1550612439",null],
            ["/questao/index","3",null,null,null,"1550612439","1550612439",null],
            ["/pergunta-avaliacao/*","3",null,null,null,"1550612439","1550612439",null],
            ["/pergunta-avaliacao/create","3",null,null,null,"1550612439","1550612439",null],
            ["/pergunta-avaliacao/create2","3",null,null,null,"1550612439","1550612439",null],
            ["/pergunta-avaliacao/update","3",null,null,null,"1550612439","1550612439",null],
            ["/pergunta-avaliacao/delete","3",null,null,null,"1550612439","1550612439",null],
            ["/pergunta-avaliacao/view","3",null,null,null,"1550612439","1550612439",null],
            ["/pergunta-avaliacao/index","3",null,null,null,"1550612439","1550612439",null],
            ["/avaliacao/*","3",null,null,null,"1550612439","1550612439",null],
            ["/avaliacao/create","3",null,null,null,"1550612439","1550612439",null],
            ["/avaliacao/update","3",null,null,null,"1550612439","1550612439",null],
            ["/avaliacao/delete","3",null,null,null,"1550612439","1550612439",null],
            ["/avaliacao/view","3",null,null,null,"1550612439","1550612439",null],
            ["/avaliacao/index","3",null,null,null,"1550612439","1550612439",null],
            ["/pergunta-avaliacao-coordenador/*","3",null,null,null,"1550612439","1550612439",null],
            ["/pergunta-avaliacao-coordenador/create","3",null,null,null,"1550612439","1550612439",null],
            ["/pergunta-avaliacao-coordenador/create2","3",null,null,null,"1550612439","1550612439",null],
            ["/pergunta-avaliacao-coordenador/update","3",null,null,null,"1550612439","1550612439",null],
            ["/pergunta-avaliacao-coordenador/delete","3",null,null,null,"1550612439","1550612439",null],
            ["/pergunta-avaliacao-coordenador/view","3",null,null,null,"1550612439","1550612439",null],
            ["/pergunta-avaliacao-coordenador/index","3",null,null,null,"1550612439","1550612439",null],
            ["/avaliacao-coordenador/*","3",null,null,null,"1550612439","1550612439",null],
            ["/avaliacao-coordenador/create","3",null,null,null,"1550612439","1550612439",null],
            ["/avaliacao-coordenador/update","3",null,null,null,"1550612439","1550612439",null],
            ["/avaliacao-coordenador/delete","3",null,null,null,"1550612439","1550612439",null],
            ["/avaliacao-coordenador/view","3",null,null,null,"1550612439","1550612439",null],
            ["/avaliacao-coordenador/index","3",null,null,null,"1550612439","1550612439",null],
            ["/questionario/listar-perguntas","3",null,null,null,"1550612439","1550612439",null],


            ["add-aluno", "2", "Adicionar Aluno", null, null, "1543320301", "1550159789", "coordenador"],
            ["add-professor", "2", "Adicionar Professor", null, null, "1543320301", "1550159789", "coordenador"],
            ["add-disciplina", "2", "Adicionar Disciplina", null, null, "1543320301", "1550159789", "professor"],
            ["add-aluno-disciplina", "2", "Adicionar Aluno Disciplina", null, null, "1543320301", "1550159789", "professor"],


            ["add-questao-add", "2", "Adicionar Questão ADD", null, null, "1543320301", "1550159789", "professor"],
            ["add-questao-qac", "2", "Adicionar Questão QAC", null, null, "1543320301", "1550159789", "coordenador"],
            ["add-questao-qacoordenador", "2", "Adicionar Questão QACoordenador", null, null, "1543320301", "1550159789", "coordenador"],

            ["responder-questao-add", "2", "Responder Questão ADD", null, null, "1543320301", "1550159789", "aluno"],
            ["responder-questao-qac", "2", "Responder Questão QAC", null, null, "1543320301", "1550159789", "aluno"],
            ["responder-questao-qacoordenador", "2", "Responder Questão QACoordenador", null, null, "1543320301", "1550159789", "aluno"],

            ["coordenador", "1", "Coordenador", null, null, "1537549774", "1537549872", null],
            ["aluno", "1", "Aluno", null, null, "1537549774", "1537549872", null],
            ["professor", "1", "Professor", null, null, "1537549774", "1537549872", null],

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        $this->delete('auth_item');
    }
}
