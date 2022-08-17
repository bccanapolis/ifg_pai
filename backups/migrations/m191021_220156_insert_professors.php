<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\User;
use app\models\Professor;

/**
 * Class m191021_220153_add_columns_professor_aluno_user
 */
class m191021_220156_insert_professors extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $password = 'superadmin';
        /**
         * Users
         */
        $this->batchInsert('user', ['id', 'username', 'status', 'auth_key', 'password_hash', 'superadmin', 'created_at','updated_at'], [
            [5, 2050719, User::STATUS_ACTIVE, md5(m191021_220156_insert_professors . phpmicrotime()), md5($password), 0, 1426062188,1426062188],
            [6, 1949756, User::STATUS_ACTIVE, md5(m191021_220156_insert_professors . phpmicrotime()), md5($password), 0, 1426062188,1426062188],
            [7, 2789063, User::STATUS_ACTIVE, md5(m191021_220156_insert_professors . phpmicrotime()), md5($password), 0, 1426062188,1426062188],
            [8, 1324561, User::STATUS_ACTIVE, md5(m191021_220156_insert_professors . phpmicrotime()), md5($password), 0, 1426062188,1426062188],
            [9, 1650583, User::STATUS_ACTIVE, md5(m191021_220156_insert_professors . phpmicrotime()), md5($password), 0, 1426062188,1426062188],
            [10, 1788576, User::STATUS_ACTIVE, md5(m191021_220156_insert_professors . phpmicrotime()), md5($password), 0, 1426062188,1426062188],
            [11, 1497734, User::STATUS_ACTIVE, md5(m191021_220156_insert_professors . phpmicrotime()), md5($password), 0, 1426062188,1426062188],
            [12, 1657700, User::STATUS_ACTIVE, md5(m191021_220156_insert_professors . phpmicrotime()), md5($password), 0, 1426062188,1426062188],
            [13, 1872739, User::STATUS_ACTIVE, md5(m191021_220156_insert_professors . phpmicrotime()), md5($password), 0, 1426062188,1426062188],
            [14, 1795183, User::STATUS_ACTIVE, md5(m191021_220156_insert_professors . phpmicrotime()), md5($password), 0, 1426062188,1426062188],
            [15, 3030604, User::STATUS_ACTIVE, md5(m191021_220156_insert_professors . phpmicrotime()), md5($password), 0, 1426062188,1426062188],
            [16, 1309313, User::STATUS_ACTIVE, md5(m191021_220156_insert_professors . phpmicrotime()), md5($password), 0, 1426062188,1426062188],
            [17, 1875022, User::STATUS_ACTIVE, md5(m191021_220156_insert_professors . phpmicrotime()), md5($password), 0, 1426062188,1426062188],
            [18, 1870062, User::STATUS_ACTIVE, md5(m191021_220156_insert_professors . phpmicrotime()), md5($password), 0, 1426062188,1426062188],
            [19, 1871930, User::STATUS_ACTIVE, md5(m191021_220156_insert_professors . phpmicrotime()), md5($password), 0, 1426062188,1426062188],
        ]);

        /**
         * Professores
         */
        $this->batchInsert('{{%professor}}', ['primeiro_nome', 'ultimo_nome', 'siape', 'tipo', 'user_id'], [
            ['Alessandro','Rodrigues', '2050719', Professor::$TIPO_PROFESSOR, 5],
            ['Alexandre','Bellezi', '1949756', Professor::$TIPO_PROFESSOR, 6],
            ['Arianny','Grasielly', '2789063', Professor::$TIPO_PROFESSOR, 7],
            ['Daniel','Xavier', '1324561', Professor::$TIPO_COORDENADOR, 8],
            ['Fabiana','Pimenta', '1650583', Professor::$TIPO_PROFESSOR, 9],
            ['Hugo','Vinícius', '1788576', Professor::$TIPO_PROFESSOR, 10],
            ['Kátia','Cilene', '1497734', Professor::$TIPO_PROFESSOR, 11],
            ['Lucas','Bernardes', '1657700', Professor::$TIPO_PROFESSOR, 12],
            ['Luiz','Fernando', '1872739', Professor::$TIPO_PROFESSOR, 13],
            ['Patrícia','Costa', '1795183', Professor::$TIPO_PROFESSOR, 14],
            ['Rovilson','Mezencio', '3030604', Professor::$TIPO_PROFESSOR, 15],
            ['Tatiele','Pereira', '1309313', Professor::$TIPO_PROFESSOR, 16],
            ['Tharsis','Souza', '1875022', Professor::$TIPO_PROFESSOR, 17],
            ['Bárbara','Delourdes', '1870062', Professor::$TIPO_PROFESSOR, 18],
            ['Bruno','Assis', '1871930', Professor::$TIPO_PROFESSOR, 19],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m191021_220153_add_columns_professor_aluno_user cannot be reverted.\n";

        return false;
    }
}
