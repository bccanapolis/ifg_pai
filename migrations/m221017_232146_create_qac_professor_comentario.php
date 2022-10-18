<?php

use yii\db\Migration;

/**
 * Class m221017_232146_create_qac_professor_comentario
 */
class m221017_232146_create_qac_professor_comentario extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%qac_professor_comentario}}', [
            'id' => $this->primaryKey(),
            'texto' => $this->text(),
            'turma_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('qac_professor_comentario_turma_id', 'qac_professor_comentario', 'turma_id', 'turma', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%qac_professor_comentario}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221017_232146_create_qac_professor_comentario cannot be reverted.\n";

        return false;
    }
    */
}
