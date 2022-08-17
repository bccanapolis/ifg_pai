<?php

use yii\db\Migration;

class m191002_154614_create_table_aluno extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%aluno}}', [
            'id' => $this->primaryKey(),
            'primeiro_nome' => $this->string()->notNull(),
            'ultimo_nome' => $this->string(),
            'matricula' => $this->string()->notNull(),
            'cpf' => $this->string(),
            'user_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('aluno_user_id','aluno','user_id','user','id');

    }

    public function down()
    {
        $this->dropTable('{{%aluno}}');
    }
}
