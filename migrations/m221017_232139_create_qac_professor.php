<?php

use yii\db\Migration;

/**
 * Class m221017_232139_create_qac_professor
 */
class m221017_232139_create_qac_professor extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%qac_professor}}', [
            'id' => $this->primaryKey(),
            'nota' => $this->integer(),
            'pergunta_id' => $this->integer()->notNull(),
            'aluno_id' => $this->integer()->notNull(),
            'turma_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('qac_professor_aluno_id', 'qac_professor', 'aluno_id', 'aluno', 'id');
        $this->addForeignKey('qac_professor_turma_id', 'qac_professor', 'turma_id', 'turma', 'id');
        $this->addForeignKey('qac_professor_pergunta_id', 'qac_professor', 'pergunta_id', 'qac_professor_pergunta', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%qac_professor}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221017_232139_create_qac_professor cannot be reverted.\n";

        return false;
    }
    */
}
