<?php

use yii\db\Migration;

/**
 * Class m221017_234151_create_qac_coordenador_comentario
 */
class m221017_234151_create_qac_coordenador_comentario extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%qac_coordenador_comentario}}', [
            'id' => $this->primaryKey(),
            'texto' => $this->text(),
            'semestre' => $this->smallInteger('2'),
            'ano' => $this->smallInteger('4'),
            'coordenacao_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('qac_coordenador_comentario_coordenacao_id', 'qac_coordenador_comentario', 'coordenacao_id', 'coordenacao', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%qac_professor_comentario}}');
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221017_234151_create_qac_coordenador_comentario cannot be reverted.\n";

        return false;
    }
    */
}
