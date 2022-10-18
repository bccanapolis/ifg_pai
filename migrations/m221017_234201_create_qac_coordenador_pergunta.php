<?php

use yii\db\Migration;

/**
 * Class m221017_234201_create_qac_coordenador_pergunta
 */
class m221017_234201_create_qac_coordenador_pergunta extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%qac_coordenador_pergunta}}', [
            'id' => $this->primaryKey(),
            'enunciado' => $this->text(),
            'curso_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('qac_coordenador_pergunta_curso_id','qac_coordenador_pergunta','curso_id','curso','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%qac_coordenador_pergunta}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221017_234201_create_qac_coordenador_pergunta cannot be reverted.\n";

        return false;
    }
    */
}
