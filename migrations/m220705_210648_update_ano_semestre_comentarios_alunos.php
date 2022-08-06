<?php

use yii\db\Migration;
use \app\models\Disciplina;

/**
 * Class m220705_210648_update_ano_semestre_comentarios_alunos
 */
class m220705_210648_update_ano_semestre_comentarios_alunos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $disciplinas = Disciplina::find()->all();

        foreach ($disciplinas as &$disciplina) {
            $this->update('comentario_avaliacao', ['ano' => $disciplina->ano, 'semestre' => $disciplina->semestre], ['id_disciplina' => $disciplina->id]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $comentarios = \app\models\ComentarioAvaliacao::find()->all();

        foreach ($comentarios as &$comentario) {
            $this->update('comentario_avaliacao', ['ano' => null, 'semestre' => null], ['id' => $comentario->id]);
        }
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220705_210648_update_ano_semestre_comentarios_alunos cannot be reverted.\n";

        return false;
    }
    */
}
