<?php

use yii\db\Migration;

/**
 * Class m191118_133118_permissao_disciplina_matriz_auth_item_child
 */
class m191118_133118_permissao_disciplina_matriz_auth_item_child extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["add-disciplina-matriz", "2", "Adicionar Disciplina", null, null, "1543320301", "1550159789", "coordenador"],
        ]);


        $this->batchInsert('auth_item_child', ['parent', 'child'], [
            ["add-disciplina-matriz","/disciplina-matriz/*"],
            ["coordenador","add-disciplina-matriz"],

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

}
