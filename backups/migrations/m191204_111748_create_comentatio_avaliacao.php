<?php

use yii\db\Migration;

/**
 * Class m191204_111748_create_comentatio_avaliacao
 */
class m191204_111748_create_comentatio_avaliacao extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%comentario_avaliacao}}', [
            'id' => $this->primaryKey(),
            'texto' => $this->text(),
            'id_disciplina' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('comentario_avaliacao_disciplina', '{{%comentario_avaliacao}}', 'id_disciplina', '{{%disciplina}}', 'id', 'RESTRICT', 'CASCADE');


        $this->createTable('{{%comentario_avaliacao_coordenador}}', [
            'id' => $this->primaryKey(),
            'texto' => $this->text(),
            'ano' => $this->integer()->notNull(),
            'semestre' => $this->smallInteger()->notNull(),
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comentario_avaliacao');
        $this->dropTable('comentario_avaliacao_coordenador');
    }

}
