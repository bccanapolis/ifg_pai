<?php

use yii\db\Migration;

class m191113_004201_pergunta_avaliacao_coordenador extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%pergunta_avaliacao_coordenador}}', [
            'id' => $this->primaryKey(),
            'enunciado' => $this->text()->notNull(),
//            'id_disciplina' => $this->integer()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%pergunta_avaliacao_coordenador}}');
    }
}
