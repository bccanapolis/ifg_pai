<?php

use yii\db\Migration;

/**
 * Class m220817_174950_create_turma
 */
class m220817_174950_create_turma extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%turma}}', [
            'id' => $this->primaryKey(),
            'semestre' => $this->smallInteger('2'),
            'ano' => $this->smallInteger('4'),
            'professor_id' => $this->integer()->notNull(),
            'disciplina_id' => $this->integer()->notNull(),
            'coordenacao_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('turma_professor_id', 'turma', 'professor_id', 'professor', 'id');
        $this->addForeignKey('turma_disciplina_id', 'turma', 'disciplina_id', 'disciplina', 'id');
        $this->addForeignKey('turma_coordenacao_id', 'turma', 'coordenacao_id', 'coordenacao', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%turma}}');
    }
}
