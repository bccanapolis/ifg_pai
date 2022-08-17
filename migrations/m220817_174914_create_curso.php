<?php

use yii\db\Migration;

/**
 * Class m220817_174914_create_curso
 */
class m220817_174914_create_curso extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%curso}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string()->notNull(),
            'campus' => $this->string()->notNull(),
            'daa' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%curso}}');
    }
}
