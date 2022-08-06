<?php

use yii\db\Migration;

/**
 * Class m191207_225517_permissao_grafico_add
 */
class m191207_225652_permissao_form_notas_disciplina extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["/notas-disciplina/create","3",null,null,null,"1550612439","1550612439",null],
        ]);

        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["add-notas-disciplina-aluno", "2", "Adicionar Nota em Disciplina", null, null, "1543320301", "1550159789", null],
        ]);

        $this->batchInsert('auth_item_child', ['parent', 'child'], [
            ["add-notas-disciplina-aluno","/notas-disciplina/create"],
            ["aluno","add-notas-disciplina-aluno"],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191207_225517_permissao_grafico_add cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191207_225517_permissao_grafico_add cannot be reverted.\n";

        return false;
    }
    */
}
