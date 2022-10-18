<?php

use yii\db\Migration;

/**
 * Class m221017_234207_create_qac_coordenador
 */
class m221017_234207_create_qac_coordenador extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%qac_coordenador}}', [
            'id' => $this->primaryKey(),
            'nota' => $this->integer(),
            'semestre' => $this->smallInteger('2'),
            'ano' => $this->smallInteger('4'),
            'aluno_id' => $this->integer()->notNull(),
            'pergunta_id' => $this->integer()->notNull(),
            'coordenacao_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('qac_coordenador_aluno_id', 'qac_coordenador', 'aluno_id', 'aluno', 'id');
        $this->addForeignKey('qac_coordenador_coordenacao_id', 'qac_coordenador', 'coordenacao_id', 'turma', 'id');
        $this->addForeignKey('qac_coordenador_pergunta_id', 'qac_coordenador', 'pergunta_id', 'qac_coordenador_pergunta', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%qac_coordenador}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221017_234207_create_qac_coordenador cannot be reverted.\n";

        return false;
    }
    */
}
