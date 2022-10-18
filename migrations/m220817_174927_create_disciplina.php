<?php

use yii\db\Migration;

/**
 * Class m220817_174927_create_disciplina
 */
class m220817_174927_create_disciplina extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%disciplina}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(),
            'codigo' => $this->integer(),
            'curso_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('disciplina_curso_id','disciplina','curso_id','curso','id');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%disciplina}}');
    }
}
