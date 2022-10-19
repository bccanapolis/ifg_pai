<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
class Curso extends ActiveRecord
{
    public static $campuses = [
        'Uruaçu', 'Goiânia', 'Itumbiara', 'Águas Lindas', 'Valparaíso', 'Luziânia', 'Goiânia Oeste', 'Anápolis', 'Formosa', 'Jataí', 'Aparecida de Goiânia', 'Senador Canedo', 'Cidade de Goiás', 'Inhumas'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'curso';
    }

    public static function representingColumn()
    {
        return 'nome';
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
     * @return ActiveQuery
     */
    public function getAlunos()
    {
        return $this->hasMany(Aluno::className(), ['curso_id' => 'id']);
    }

    /**
     * Gets query for [[Coordenacaos]].
     *
     * @return ActiveQuery
     */
    public function getCoordenacaos()
    {
        return $this->hasMany(Coordenacao::className(), ['curso_id' => 'id']);
    }

    /**
     * Gets query for [[Disciplinas]].
     *
     * @return ActiveQuery
     */
    public function getDisciplinas()
    {
        return $this->hasMany(Disciplina::className(), ['curso_id' => 'id']);
    }
}
