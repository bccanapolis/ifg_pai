<?php

use yii\db\Migration;

class m191002_154615_create_table_aluno_disciplina extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%aluno_disciplina}}', [
            'id' => $this->primaryKey(),
            'id_disciplina' => $this->integer()->notNull(),
            'id_aluno' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('aluno_disciplina_unique', '{{%aluno_disciplina}}', ['id_disciplina', 'id_aluno'], true);
        $this->addForeignKey('disciplina_fk', '{{%aluno_disciplina}}', 'id_disciplina', '{{%disciplina}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('aluno_fk', '{{%aluno_disciplina}}', 'id_aluno', '{{%aluno}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%aluno_disciplina}}');
    }
}
