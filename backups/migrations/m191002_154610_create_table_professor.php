<?php

use yii\db\Migration;

class m191002_154610_create_table_professor extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%professor}}', [
            'id' => $this->primaryKey(),
            'siape' => $this->string()->notNull(),
            'primeiro_nome' => $this->string()->notNull(),
            'ultimo_nome' => $this->string(),
            'tipo' => $this->integer()->notNull()->defaultValue(1),
            'user_id' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('professor_user_id','professor','user_id','user','id');
    }

    public function down()
    {
        $this->dropTable('{{%professor}}');
    }
}
