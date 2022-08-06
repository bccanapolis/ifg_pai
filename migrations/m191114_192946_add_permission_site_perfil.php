<?php

use yii\db\Migration;

/**
 * Class m191114_192946_add_permission_site_perfil
 */
class m191114_192946_add_permission_site_perfil extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["/site/view-profile", "3", null, null, null, "1550612439", "1550612439", null],

            ["site-perfil", "2", "Site Perfil", null, null, "1543320301", "1550159789", null],
        ]);

        $this->batchInsert('auth_item_child', ['parent', 'child'], [
            ["site-perfil", "/site/view-profile"],
            ["aluno","site-perfil"],
            ["professor","site-perfil"],
            ["coordenador","site-perfil"],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191114_192946_add_permission_site_perfil cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191114_192946_add_permission_site_perfil cannot be reverted.\n";

        return false;
    }
    */
}
