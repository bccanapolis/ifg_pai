<?php

use yii\db\Migration;

/**
 * Class m210813_193222_add_disciplina_libras
 */
class m210813_193222_add_disciplina_libras extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('disciplina_matriz',
            [
                'id' => 47,
                'nome' => 'LIBRAS',
                'sigla' => 'LIB',
            ]
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210813_193222_add_disciplina_libras cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210813_193222_add_disciplina_libras cannot be reverted.\n";

        return false;
    }
    */
}
