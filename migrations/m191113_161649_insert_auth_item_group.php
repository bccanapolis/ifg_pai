<?php

use yii\db\Migration;

/**
 * Class m190214_180134_insert_auth_item_group
 */
class m191113_161649_insert_auth_item_group extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('auth_item_group', ['code', 'name', 'created_at', 'updated_at'], [
            ["professor","Professor","1550005574","1550005574"],
            ["coordenador","Coordenador","1550005574","1550005574"],
            ["aluno","Aluno","1550005574","1550005574"],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('auth_item_group');
    }
}
