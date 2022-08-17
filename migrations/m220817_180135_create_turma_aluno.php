<?php

use yii\db\Migration;

/**
 * Class m220817_180135_create_turma_aluno
 */
class m220817_180135_create_turma_aluno extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%turma_aluno}}', [
            'id' => $this->primaryKey(),
            'aluno_id' => $this->integer()->notNull(),
            'turma_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('turma_aluno_aluno_id','turma_aluno','aluno_id','aluno','id');
        $this->addForeignKey('turma_aluno_turma_id','turma_aluno','turma_id','turma','id');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%turma_aluno}}');
    }
}
