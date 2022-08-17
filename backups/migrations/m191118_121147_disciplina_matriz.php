<?php

use yii\db\Migration;

/**
 * Class m191118_121147_disciplina_matriz
 */
class m191118_121147_disciplina_matriz extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%disciplina_matriz}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->text()->notNull(),
        ], $tableOptions);

        $this->addColumn('disciplina', 'id_disciplina_matriz', $this->integer());
        $this->addForeignKey('disciplina_disciplina_matriz', '{{%disciplina}}', 'id_disciplina_matriz', '{{%disciplina_matriz}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%disciplina_matriz}}');
    }
}
