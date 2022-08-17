<?php

use yii\db\Migration;

/**
 * Class m191118_132643_permissao_disciplina_matriz
 */
class m191120_162643_permissao_grafico extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["/grafico/professor","3",null,null,null,"1550612439","1550612439",null],
            ["/grafico/coordenador","3",null,null,null,"1550612439","1550612439",null],
            ["/grafico/api-professor","3",null,null,null,"1550612439","1550612439",null],
            ["/grafico/api-coordenador","3",null,null,null,"1550612439","1550612439",null],
            ["/grafico/disciplina","3",null,null,null,"1550612439","1550612439",null],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

}
