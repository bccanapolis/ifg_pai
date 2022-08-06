<?php

use yii\db\Migration;

/**
 * Class m191207_225647_permissao_grafico_add_auth_item_child
 */
class m191207_225647_permissao_grafico_add_auth_item_child extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["grafico-add", "2", "Gráfico ADD", null, null, "1543320301", "1550159789", null],
        ]);


        $this->batchInsert('auth_item_child', ['parent', 'child'], [
            ["grafico-add","/grafico/add"],
            ["grafico-add","/grafico/api-add"],
            ["aluno","grafico-add"],
            ["professor","grafico-add"],
            ["coordenador","grafico-add"],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191207_225647_permissao_grafico_add_auth_item_child cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191207_225647_permissao_grafico_add_auth_item_child cannot be reverted.\n";

        return false;
    }
    */
}
