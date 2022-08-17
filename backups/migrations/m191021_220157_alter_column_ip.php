<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\User;
use app\models\Professor;

/**
 * Class m191021_220153_add_columns_professor_aluno_user
 */
class m191021_220157_alter_column_ip extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->alterColumn('user','registration_ip',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m191021_220153_add_columns_professor_aluno_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191021_220153_add_columns_professor_aluno_user cannot be reverted.\n";

        return false;
    }
    */
}
