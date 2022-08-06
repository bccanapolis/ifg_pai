<?php

use yii\db\Migration;

/**
 * Class m191118_133118_permissao_disciplina_matriz_auth_item_child
 */
class m191120_163118_permissao_grafico_auth_item_child extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at', 'group_code'], [
            ["grafico-professor", "2", "Gráfico professor", null, null, "1543320301", "1550159789", null],
            ["grafico-coordenador", "2", "Gráfico coordenador", null, null, "1543320301", "1550159789", null],
        ]);


        $this->batchInsert('auth_item_child', ['parent', 'child'], [
            ["grafico-professor","/grafico/professor"],
            ["grafico-professor","/grafico/api-professor"],
            ["grafico-professor","/grafico/disciplina"],
            ["grafico-coordenador","/grafico/coordenador"],
            ["grafico-coordenador","/grafico/api-coordenador"],
            ["aluno","grafico-professor"],
            ["aluno","grafico-coordenador"],
            ["professor","grafico-professor"],
            ["professor","grafico-coordenador"],
            ["coordenador","grafico-professor"],
            ["coordenador","grafico-coordenador"],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

}
