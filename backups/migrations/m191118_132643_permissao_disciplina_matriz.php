<?php

use yii\db\Migration;

/**
 * Class m191118_132643_permissao_disciplina_matriz
 */
class m191118_132643_permissao_disciplina_matriz extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [

            ["/disciplina-matriz/*","3",null,null,null,"1550612439","1550612439",null],
            ["/disciplina-matriz/create","3",null,null,null,"1550612439","1550612439",null],
            ["/disciplina-matriz/update","3",null,null,null,"1550612439","1550612439",null],
            ["/disciplina-matriz/delete","3",null,null,null,"1550612439","1550612439",null],
            ["/disciplina-matriz/view","3",null,null,null,"1550612439","1550612439",null],
            ["/disciplina-matriz/index","3",null,null,null,"1550612439","1550612439",null],

        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

}
