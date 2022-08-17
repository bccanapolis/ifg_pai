<?php

use yii\db\Migration;

/**
 * Class m210813_201709_update_disciplina_probabilidade
 */
class m210813_201709_update_disciplina_probabilidade extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->update('disciplina_matriz', ['nome'=>'PROBABILIDADE E ESTATISTICA'], ['id'=>32]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210813_201709_update_disciplina_probabilidade cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210813_201709_update_disciplina_probabilidade cannot be reverted.\n";

        return false;
    }
    */
}
