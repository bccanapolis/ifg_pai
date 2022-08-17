<?php

use yii\db\Migration;

/**
 * Class m191114_170500_add_primary_keys
 */
class m191114_170500_add_primary_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('avaliacao', 'id');
        $this->dropColumn('avaliacao_coordenador', 'id');
        $this->addColumn('avaliacao', 'id', $this->primaryKey()->notNull());
        $this->addColumn('avaliacao_coordenador', 'id', $this->primaryKey()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

}
