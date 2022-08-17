<?php

use yii\db\Migration;

/**
 * Class m191120_013623_add_sigla_disciplina
 */
class m191120_013623_add_sigla_disciplina extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('disciplina_matriz', 'sigla', $this->text(10));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('disciplina_matriz', 'sigla');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191120_013623_add_sigla_disciplina cannot be reverted.\n";

        return false;
    }
    */
}
