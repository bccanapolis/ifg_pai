<?php

use yii\db\Migration;

class m191113_004407_avaliacao_coordenador extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%avaliacao_coordenador}}', [
            'id' => $this->integer(),
            'nota' => $this->smallInteger()->notNull(),
            'id_aluno' => $this->integer()->notNull(),
            'id_pergunta_avaliacao_coordenador' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('aluno_fk', '{{%avaliacao_coordenador}}', 'id_aluno', '{{%aluno}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('pergunta_avaliacao_coordenador_fk', '{{%avaliacao_coordenador}}', 'id_pergunta_avaliacao_coordenador', '{{%pergunta_avaliacao_coordenador}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%avaliacao_coordenador}}');
    }
}
