<?php

namespace app\models;

/**
 * This is the model class for table "aluno".
 *
 * @property int $id
 * @property string $primeiro_nome
 * @property string|null $ultimo_nome
 * @property string $matricula
 * @property string|null $cpf
 * @property int $user_id
 * @property int $curso_id
 *
 * @property Curso $curso
 * @property TurmaAluno[] $turmaAlunos
 * @property User $user
 */
class Aluno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aluno';
    }

    public static function representingColumn()
    {
        return 'matricula';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['primeiro_nome', 'matricula', 'user_id', 'curso_id'], 'required'],
            [['user_id', 'curso_id'], 'default', 'value' => null],
            [['user_id', 'curso_id'], 'integer'],
            [['primeiro_nome', 'ultimo_nome', 'matricula', 'cpf'], 'string', 'max' => 255],
            [['curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['curso_id' => 'id']],
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
            'primeiro_nome' => 'Primeiro Nome',
            'ultimo_nome' => 'Ultimo Nome',
            'matricula' => 'Matricula',
            'cpf' => 'Cpf',
            'user_id' => 'User ID',
            'curso_id' => 'Curso ID',
        ];
    }

    /**
     * Gets query for [[Curso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurso()
    {
        return $this->hasOne(Curso::className(), ['id' => 'curso_id']);
    }

    /**
     * Gets query for [[TurmaAlunos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurmaAlunos()
    {
        return $this->hasMany(TurmaAluno::className(), ['aluno_id' => 'id']);
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
