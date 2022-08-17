<?php

use yii\db\Migration;

/**
 * Class m191207_145422_permissao_comentario
 */
class m191207_145422_permissao_comentario extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["/comentario-avaliacao/index","3",null,null,null,"1550612439","1550612439",null],
            ["/comentario-avaliacao-coordenador/index","3",null,null,null,"1550612439","1550612439",null],
        ]);

        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["comentario-avaliacao-index", "2", "Ver comentario Disciplina", null, null, "1543320301", "1550159789", "professor"],
            ["comentario-avaliacao-coordenador-index", "2", "Ver comentario Coordenador Disciplina", null, null, "1543320301", "1550159789", "coordenador"],
        ]);

        $this->batchInsert('auth_item_child', ['parent', 'child'], [
            ["comentario-avaliacao-index","/comentario-avaliacao/index"],
            ["professor","comentario-avaliacao-index"],

            ["comentario-avaliacao-coordenador-index","/comentario-avaliacao-coordenador/index"],
            ["coordenador","comentario-avaliacao-coordenador-index"],

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }


}
