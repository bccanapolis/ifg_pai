<?php

use yii\db\Migration;

/**
 * Class m191204_220357_permission_dashboard_and_pdf_questoes
 */
class m191204_220360_permission_normalizacao_notas extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["/notas/normalizacao","3",null,null,null,"1550612439","1550612439",null],
        ]);

        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["normalizar-notas", "2", "Normalização de Notas", null, null, "1543320301", "1550159789", null],
        ]);

        $this->batchInsert('auth_item_child', ['parent', 'child'], [
            ["normalizar-notas","/notas/normalizacao"],
            ["professor","normalizar-notas"],
            ["coordenador","normalizar-notas"],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
