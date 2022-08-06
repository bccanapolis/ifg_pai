<?php

use yii\db\Migration;

/**
 * Class m191113_012903_add_column_avaliacao_coordenador
 */
class m191113_012903_add_column_avaliacao_coordenador extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('avaliacao_coordenador', 'ano', $this->integer());
        $this->addColumn('avaliacao_coordenador', 'semestre', $this->smallInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('avaliacao_coordenador', 'ano');
        $this->dropColumn('avaliacao_coordenador', 'semestre');
    }


}
