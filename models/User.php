<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $cpf
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 *
// * @property Aluno $aluno
// * @property Professor $professor
 */
class User extends \webvimark\modules\UserManagement\models\User
{
    /**
     * @inheritdoc
     */
    public static function representingColumn()
    {
        return 'username';
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id'                 => 'ID',
            'username'           => 'Login',
            'superadmin'         => 'Superadmin',
            'confirmation_token' => 'Confirmation Token',
            'registration_ip'    => 'Registration IP',
            'bind_to_ip'         => 'Bind to IP',
            'status'             => 'Status',
            'gridRoleSearch'     => 'Roles',
            'created_at'         => 'Created',
            'updated_at'         => 'Updated',
            'password'           => 'Password',
            'repeat_password'    => 'Repeat password',
            'email_confirmed'    => 'E-mail confirmed',
            'email'              => 'E-mail',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAluno()
    {
        return $this->hasOne(\app\models\Aluno::className(), ['user_id' => 'id']);
    }
    public function getProfessor()
    {
        return $this->hasOne(\app\models\Professor::className(), ['user_id' => 'id']);
    }
}