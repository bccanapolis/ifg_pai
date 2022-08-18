<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "turma_aluno".
 *
 * @property int $id
 * @property int $aluno_id
 * @property int $turma_id
 *
 * @property Aluno $aluno
 * @property Turma $turma
 */
class TurmaAluno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'turma_aluno';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aluno_id', 'turma_id'], 'required'],
            [['aluno_id', 'turma_id'], 'default', 'value' => null],
            [['aluno_id', 'turma_id'], 'integer'],
            [['aluno_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['aluno_id' => 'id']],
            [['turma_id'], 'exist', 'skipOnError' => true, 'targetClass' => Turma::className(), 'targetAttribute' => ['turma_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'aluno_id' => 'Aluno ID',
            'turma_id' => 'Turma ID',
        ];
    }

    /**
     * Gets query for [[Aluno]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAluno()
    {
        return $this->hasOne(Aluno::className(), ['id' => 'aluno_id']);
    }

    /**
     * Gets query for [[Turma]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurma()
    {
        return $this->hasOne(Turma::className(), ['id' => 'turma_id']);
    }
}
