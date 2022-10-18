<?php

use yii\db\Migration;

/**
 * Class m220817_174903_create_professor
 */
class m220817_174903_create_professor extends Migration
{
    public function up()
    {
        $this->createTable('{{%professor}}', [
            'id' => $this->primaryKey(),
            'siape' => $this->string()->notNull(),
            'primeiro_nome' => $this->string(),
            'ultimo_nome' => $this->string(),
            'tipo' => $this->integer()->notNull()->defaultValue(1),
            'user_id' => $this->integer(),
        ]);

        $this->addForeignKey('professor_user_id','professor','user_id','user','id');
    }

    public function down()
    {
        $this->dropTable('{{%professor}}');
    }
}
