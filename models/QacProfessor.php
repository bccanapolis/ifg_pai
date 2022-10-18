<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qac_professor".
 *
 * @property int $id
 * @property int|null $nota
 * @property int $pergunta_id
 * @property int $aluno_id
 * @property int $turma_id
 *
 * @property Aluno $aluno
 * @property QacProfessorPerguntum $pergunta
 * @property Turma $turma
 */
class QacProfessor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'qac_professor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nota', 'pergunta_id', 'aluno_id', 'turma_id'], 'default', 'value' => null],
            [['nota', 'pergunta_id', 'aluno_id', 'turma_id'], 'integer'],
            [['pergunta_id', 'aluno_id', 'turma_id'], 'required'],
            [['aluno_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['aluno_id' => 'id']],
            [['pergunta_id'], 'exist', 'skipOnError' => true, 'targetClass' => QacProfessorPerguntum::className(), 'targetAttribute' => ['pergunta_id' => 'id']],
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
            'nota' => 'Nota',
            'pergunta_id' => 'Pergunta ID',
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
     * Gets query for [[Pergunta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPergunta()
    {
        return $this->hasOne(QacProfessorPerguntum::className(), ['id' => 'pergunta_id']);
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
