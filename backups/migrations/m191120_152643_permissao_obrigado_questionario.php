<?php

use yii\db\Migration;

/**
 * Class m191118_132643_permissao_disciplina_matriz
 */
class m191120_152643_permissao_obrigado_questionario extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["/questionario/finality-form","3",null,null,null,"1550612439","1550612439",null],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

}
