<?php

use yii\db\Migration;

/**
 * Class m191112_201607_drop_index_id_questao_alternativa
 */
class m191112_201607_drop_index_id_questao_alternativa extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropIndex('alternativa_uq', '{{%alternativa}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

}
