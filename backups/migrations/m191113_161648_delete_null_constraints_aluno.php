<?php

use yii\db\Migration;

/**
 * Class m191113_161648_delete_null_constraints_aluno
 */
class m191113_161648_delete_null_constraints_aluno extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->alterColumn('aluno', 'primeiro_nome', $this->string());
        $this->alterColumn('aluno', 'user_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }


}
