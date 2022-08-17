<?php

use yii\db\Migration;

/**
 * Class m191207_225517_permissao_grafico_add
 */
class m191207_225517_permissao_grafico_add extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["/grafico/add","3",null,null,null,"1550612439","1550612439",null],
            ["/grafico/api-add","3",null,null,null,"1550612439","1550612439",null],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191207_225517_permissao_grafico_add cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191207_225517_permissao_grafico_add cannot be reverted.\n";

        return false;
    }
    */
}
