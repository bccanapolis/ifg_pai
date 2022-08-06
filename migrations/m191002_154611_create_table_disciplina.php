<?php

use yii\db\Migration;

class m191002_154611_create_table_disciplina extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%disciplina}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->text()->notNull(),
            'ano' => $this->integer()->notNull(),
            'semestre' => $this->smallInteger()->notNull(),
            'id_professor' => $this->integer()->notNull(),
        ], $tableOptions);

//        Pode ocorrer de um professor dar duas materias no mesmo ano e semestre
//        $this->createIndex('ano_semestre_disciplina_unique', '{{%disciplina}}', ['ano', 'semestre'], true);
//        $this->createIndex('disciplina_uq', '{{%disciplina}}', 'id_professor', true);
        $this->addForeignKey('professor_fk', '{{%disciplina}}', 'id_professor', '{{%professor}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%disciplina}}');
    }
}
