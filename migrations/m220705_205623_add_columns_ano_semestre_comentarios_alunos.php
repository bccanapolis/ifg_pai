<?php

use yii\db\Migration;

/**
 * Class m220705_205623_add_columns_ano_semestre_comentarios_alunos
 */
class m220705_205623_add_columns_ano_semestre_comentarios_alunos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('comentario_avaliacao', 'ano', $this->integer());
        $this->addColumn('comentario_avaliacao', 'semestre', $this->smallInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('comentario_avaliacao', 'ano');
        $this->dropColumn('comentario_avaliacao', 'semestre');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220705_205623_add_columns_ano_semestre_comentarios_alunos cannot be reverted.\n";

        return false;
    }
    */
}
