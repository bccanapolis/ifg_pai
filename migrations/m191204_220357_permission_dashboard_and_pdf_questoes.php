<?php

use yii\db\Migration;

/**
 * Class m191204_220357_permission_dashboard_and_pdf_questoes
 */
class m191204_220357_permission_dashboard_and_pdf_questoes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["/questionario/gerar-pdf","3",null,null,null,"1550612439","1550612439",null],
        ]);

        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["imprimir-questoes", "2", "Imprimir Questões", null, null, "1543320301", "1550159789", null],
            ["site-dashboard", "2", "Site Dashboard", null, null, "1543320301", "1550159789", null],
        ]);

        $this->batchInsert('auth_item_child', ['parent', 'child'], [
            ["imprimir-questoes","/questionario/gerar-pdf"],
            ["coordenador","imprimir-questoes"],
            ["site-dashboard","/site/index"],
            ["aluno","site-dashboard"],
            ["professor","site-dashboard"],
            ["coordenador","site-dashboard"],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
