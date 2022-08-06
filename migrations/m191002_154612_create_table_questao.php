<?php

use yii\db\Migration;

class m191002_154612_create_table_questao extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%questao}}', [
            'id' => $this->primaryKey(),
            'enunciado' => $this->text()->notNull(),
            'id_disciplina' => $this->integer()->notNull(),
            'imagem' => $this->text(),
        ], $tableOptions);

        $this->addForeignKey('disciplina_fk', '{{%questao}}', 'id_disciplina', '{{%disciplina}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%questao}}');
    }
}
