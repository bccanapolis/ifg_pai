<?php

use yii\db\Migration;

/**
 * Class m210813_193209_update_discipline_etinicoraciais
 */
class m210813_193209_update_discipline_etinicoraciais extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->update('disciplina_matriz', ['nome'=>'EDUCACAO DAS RELACOES ETNICO-RACIAIS E AFRODESCENDENCIA'], ['id'=>11]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210813_193209_update_discipline_etinicoraciais cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210813_193209_update_discipline_etinicoraciais cannot be reverted.\n";

        return false;
    }
    */
}
