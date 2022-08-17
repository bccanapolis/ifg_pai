<?php

use yii\db\Migration;

class m191002_154613_create_table_alternativa extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%alternativa}}', [
            'id' => $this->primaryKey(),
            'descricao' => $this->text()->notNull(),
            'correta' => $this->boolean()->notNull(),
            'id_questao' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('alternativa_uq', '{{%alternativa}}', 'id_questao', false);
        $this->addForeignKey('questao_fk', '{{%alternativa}}', 'id_questao', '{{%questao}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%alternativa}}');
    }
}
