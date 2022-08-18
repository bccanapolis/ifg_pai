<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curso".
 *
 * @property int $id
 * @property string $nome
 * @property string $campus
 * @property int $daa
 *
 * @property Aluno[] $alunos
 * @property Coordenacao[] $coordenacaos
 * @property Disciplina[] $disciplinas
 */
class Curso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'curso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'campus', 'daa'], 'required'],
            [['daa'], 'default', 'value' => null],
            [['daa'], 'integer'],
            [['nome', 'campus'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'campus' => 'Campus',
            'daa' => 'Daa',
        ];
    }

    /**
     * Gets query for [[Alunos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlunos()
    {
        return $this->hasMany(Aluno::className(), ['curso_id' => 'id']);
    }

    /**
     * Gets query for [[Coordenacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoordenacaos()
    {
        return $this->hasMany(Coordenacao::className(), ['curso_id' => 'id']);
    }

    /**
     * Gets query for [[Disciplinas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplinas()
    {
        return $this->hasMany(Disciplina::className(), ['curso_id' => 'id']);
    }
}
