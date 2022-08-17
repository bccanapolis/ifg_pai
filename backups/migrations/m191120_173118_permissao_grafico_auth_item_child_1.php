<?php

use yii\db\Migration;

/**
 * Class m191118_133118_permissao_disciplina_matriz_auth_item_child
 */
class m191120_173118_permissao_grafico_auth_item_child_1 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["grafico-index", "2", "Gráfico index", null, null, "1543320301", "1550159789", null],
        ]);


        $this->batchInsert('auth_item_child', ['parent', 'child'], [
            ["grafico-index","/grafico/index"],
            ["aluno","grafico-index"],
            ["professor","grafico-index"],
            ["coordenador","grafico-index"],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

}
