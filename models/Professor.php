<?php

namespace app\models;

/**
 * This is the model class for table "professor".
 *
 * @property int $id
 * @property string $siape
 * @property string $primeiro_nome
 * @property string|null $ultimo_nome
 * @property int $tipo
 * @property int|null $user_id
 *
 * @property Coordenacao[] $coordenacaos
 * @property Turma[] $turmas
 * @property User $user
 */
class Professor extends \yii\db\ActiveRecord
{
    public static array $tipos = [
        1 => 'Professor',
        2 => 'Coordenador',
        3 => 'Diretor',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'professor';
    }

    public static function representingColumn()
    {
        return 'primeiro_nome';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['siape', 'primeiro_nome'], 'required'],
            [['tipo', 'user_id'], 'default', 'value' => null],
            [['tipo', 'user_id'], 'integer'],
            [['siape', 'primeiro_nome', 'ultimo_nome'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'siape' => 'Siape',
            'primeiro_nome' => 'Primeiro Nome',
            'ultimo_nome' => 'Ultimo Nome',
            'tipo' => 'Tipo',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Coordenacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoordenacaos()
    {
        return $this->hasMany(Coordenacao::className(), ['professor_id' => 'id']);
    }

    /**
     * Gets query for [[Turmas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurmas()
    {
        return $this->hasMany(Turma::className(), ['professor_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
