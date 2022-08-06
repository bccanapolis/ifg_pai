<?php

use yii\db\Migration;

class m191002_154616_create_table_pergunta_avaliacao extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%pergunta_avaliacao}}', [
            'id' => $this->primaryKey(),
            'enunciado' => $this->text()->notNull(),
//            'id_disciplina' => $this->integer()->notNull(),
        ], $tableOptions);

//        $this->addForeignKey('disciplina_fk', '{{%pergunta_avaliacao}}', 'id_disciplina', '{{%disciplina}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%pergunta_avaliacao}}');
    }
}
