<?php

namespace app\models;

/**
 * This is the model class for table "coordenacao".
 *
 * @property int $id
 * @property int $professor_id
 * @property int $curso_id
 *
 * @property Curso $curso
 * @property Professor $professor
 * @property Turma[] $turmas
 */
class Coordenacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coordenacao';
    }

    public static function representingColumn()
    {
        return 'professor_id';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['professor_id', 'curso_id'], 'required'],
            [['professor_id', 'curso_id'], 'default', 'value' => null],
            [['professor_id', 'curso_id'], 'integer'],
            [['curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['curso_id' => 'id']],
            [['professor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Professor::className(), 'targetAttribute' => ['professor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'professor_id' => 'Professor ID',
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
     * Gets query for [[Professor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfessor()
    {
        return $this->hasOne(Professor::className(), ['id' => 'professor_id']);
    }

    /**
     * Gets query for [[Turmas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurmas()
    {
        return $this->hasMany(Turma::className(), ['coordenacao_id' => 'id']);
    }
}
