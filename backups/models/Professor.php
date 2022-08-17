<?php

namespace app\models;

use Yii;

/**
 * This is the base model class for table "professor".
 *
 * @property integer $id
 * @property string $siape
 * @property string $primeiro_nome
 * @property string $ultimo_nome
 * @property integer $tipo
 * @property integer $user_id
 *
 * @property \app\models\Disciplina[] $disciplinas
 * @property \app\models\User $user
 */
class Professor extends \yii\db\ActiveRecord
{
    public static $TIPO_PROFESSOR = 1;
    public static $TIPO_COORDENADOR = 2;

    public function behaviors(){
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['siape', 'primeiro_nome'], 'required'],
            [['tipo', 'user_id'], 'default', 'value' => null],
            [['tipo', 'user_id'], 'integer'],
            [['siape', 'primeiro_nome', 'ultimo_nome'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'professor';
    }

    /**
    * @inheritdoc
    */
    public static function representingColumn()
    {
        return 'primeiro_nome';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'siape' => 'Siape',
            'primeiro_nome' => 'Primeiro Nome',
            'ultimo_nome' => 'Último Nome',
            'tipo' => 'Tipo',
            'user_id' => 'User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplinas()
    {
        return $this->hasMany(\app\models\Disciplina::className(), ['id_professor' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }
}
