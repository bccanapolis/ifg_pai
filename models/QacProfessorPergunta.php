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

    public static function representingColumn()
    {
        return 'enunciado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enunciado'], 'string'],
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
        ];
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
