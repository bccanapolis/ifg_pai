<?php

use yii\db\Migration;

class m191002_154618_create_table_resposta extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%resposta}}', [
            'id' => $this->primaryKey(),
            'id_aluno' => $this->integer()->notNull(),
            'id_questao' => $this->integer()->notNull(),
            'id_alternativa' => $this->integer()->notNull(),
        ], $tableOptions);

        //$this->createIndex('resposta_uq', '{{%resposta}}', 'id_alternativa', true);
        $this->addForeignKey('aluno_fk', '{{%resposta}}', 'id_aluno', '{{%aluno}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('alternativa_fk', '{{%resposta}}', 'id_alternativa', '{{%alternativa}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('questao_fk', '{{%resposta}}', 'id_questao', '{{%questao}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%resposta}}');
    }
}
