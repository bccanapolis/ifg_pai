<?php

use yii\db\Migration;

/**
 * Class m191118_133118_permissao_disciplina_matriz_auth_item_child
 */
class m191120_153118_permissao_obrigado_questionario_auth_item_child extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["obrigado-form-questionario", "2", "Obrigado por responder o questionario", null, null, "1543320301", "1550159789", null],
        ]);


        $this->batchInsert('auth_item_child', ['parent', 'child'], [
            ["obrigado-form-questionario","/questionario/finality-form"],
            ["aluno","obrigado-form-questionario"],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

}
