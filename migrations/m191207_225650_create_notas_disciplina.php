<?php

use yii\db\Migration;

/**
 * Class m191204_111748_create_comentatio_avaliacao
 */
class m191207_225650_create_notas_disciplina extends Migration
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

        $this->createTable('{{%notas_disciplina}}', [
            'id' => $this->primaryKey(),
            'id_aluno' => $this->integer()->notNull(),
            'id_disciplina' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('notas_disciplina_aluno_id', '{{%notas_disciplina}}', 'id_aluno', '{{%aluno}}', 'id');
        $this->addForeignKey('notas_disciplina_disciplina_id', '{{%notas_disciplina}}', 'id_disciplina', '{{%disciplina}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('notas_disciplina');
    }

}
