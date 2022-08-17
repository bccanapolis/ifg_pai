<?php

use yii\db\Migration;

/**
 * Class m210814_064300_update_disciplina_mobile
 */
class m210814_064300_update_disciplina_mobile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->update('disciplina_matriz', ['nome'=>'PROGRAMACAO PARA DISPOSITIVOS MOVEIS'], ['id'=>34]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210814_064300_update_disciplina_mobile cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210814_064300_update_disciplina_mobile cannot be reverted.\n";

        return false;
    }
    */
}
