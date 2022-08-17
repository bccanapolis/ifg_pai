<?php

use yii\db\Migration;

/**
 * Class m220817_174954_create_aluno
 */
class m220817_174954_create_aluno extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%aluno}}', [
            'id' => $this->primaryKey(),
            'primeiro_nome' => $this->string()->notNull(),
            'ultimo_nome' => $this->string(),
            'matricula' => $this->string()->notNull(),
            'cpf' => $this->string(),
            'user_id' => $this->integer()->notNull(),
            'curso_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('aluno_curso_id','aluno','curso_id','curso','id');
        $this->addForeignKey('aluno_user_id','aluno','user_id','user','id');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%aluno}}');
    }
}
