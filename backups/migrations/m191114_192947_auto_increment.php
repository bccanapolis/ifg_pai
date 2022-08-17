<?php

use yii\db\Migration;

/**
 * Class m191114_191317_auto_increment
 */
class m191114_192947_auto_increment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('ALTER SEQUENCE user_seq INCREMENT 1;');
        $this->execute('ALTER SEQUENCE aluno_id_seq INCREMENT 1;');
        $this->execute('ALTER SEQUENCE aluno_disciplina_id_seq INCREMENT 1;');
        $this->execute('ALTER SEQUENCE professor_id_seq INCREMENT 1;');
        $this->execute('ALTER SEQUENCE pergunta_avaliacao_coordenador_id_seq INCREMENT 1;');
        $this->execute('ALTER SEQUENCE pergunta_avaliacao_id_seq INCREMENT 1;');
        $this->execute('ALTER SEQUENCE disciplina_id_seq INCREMENT 1;');

//        $this->execute('SELECT setval(\'user_seq\', (SELECT MAX(id) FROM 'user'));');
        $this->execute('SELECT setval(\'aluno_id_seq\', (SELECT MAX(id) FROM aluno));');
        $this->execute('SELECT setval(\'aluno_disciplina_id_seq\', (SELECT MAX(id) FROM aluno_disciplina));');
        $this->execute('SELECT setval(\'professor_id_seq\', (SELECT MAX(id) FROM professor));');
        $this->execute('SELECT setval(\'pergunta_avaliacao_coordenador_id_seq\', (SELECT MAX(id) FROM pergunta_avaliacao_coordenador));');
        $this->execute('SELECT setval(\'pergunta_avaliacao_id_seq\', (SELECT MAX(id) FROM pergunta_avaliacao));');
        $this->execute('SELECT setval(\'disciplina_id_seq\', (SELECT MAX(id) FROM disciplina));');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }


}
