<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qac_professor_pergunta".
 *
 * @property int $id
 * @property string|null $enunciado
 * @property int $curso_id
 *
 * @property Curso $curso
 * @property QacProfessor[] $qacProfessors
 */
class QacProfessorPergunta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'qac_professor_pergunta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enunciado'], 'string'],
            [['curso_id'], 'required'],
            [['curso_id'], 'default', 'value' => null],
            [['curso_id'], 'integer'],
            [['curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['curso_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enunciado' => 'Enunciado',
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
     * Gets query for [[QacProfessors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQacProfessors()
    {
        return $this->hasMany(QacProfessor::className(), ['pergunta_id' => 'id']);
    }
}
