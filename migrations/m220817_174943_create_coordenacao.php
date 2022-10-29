<?php

use yii\db\Migration;

/**
 * Class m220817_174943_create_coordenacao
 */
class m220817_174943_create_coordenacao extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%coordenacao}}', [
            'id' => $this->primaryKey(),
            'professor_id' => $this->integer(),
            'curso_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('coordenacao_curso_id','coordenacao','curso_id','curso','id');
        $this->addForeignKey('coordenacao_professor_id','coordenacao','professor_id','professor','id');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%coordenacao}}');
    }
}
