<?php

use yii\db\Migration;

class m191002_154617_create_table_avaliacao extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%avaliacao}}', [
            'id' => $this->integer(),
            'nota' => $this->smallInteger()->notNull(),
            'id_aluno' => $this->integer()->notNull(),
            'id_pergunta_avaliacao' => $this->integer()->notNull(),
            'id_disciplina' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('disciplina_fk', '{{%avaliacao}}', 'id_disciplina', '{{%disciplina}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('aluno_fk', '{{%avaliacao}}', 'id_aluno', '{{%aluno}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('pergunta_avaliacao_fk', '{{%avaliacao}}', 'id_pergunta_avaliacao', '{{%pergunta_avaliacao}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%avaliacao}}');
    }
}
