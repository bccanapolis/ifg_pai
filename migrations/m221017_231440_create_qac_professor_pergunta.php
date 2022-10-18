<?php

use yii\db\Migration;

/**
 * Class m221017_231440_create_qac_professorPergunta
 */
class m221017_231440_create_qac_professor_pergunta extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%qac_professor_pergunta}}', [
            'id' => $this->primaryKey(),
            'enunciado' => $this->text(),
            'curso_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('qac_professor_pergunta_curso_id','qac_professor_pergunta','curso_id','curso','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%qac_professor_pergunta}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221017_231440_create_qac_professorPergunta cannot be reverted.\n";

        return false;
    }
    */
}
