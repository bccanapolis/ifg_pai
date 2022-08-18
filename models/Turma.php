<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "turma".
 *
 * @property int $id
 * @property string $nome
 * @property int|null $semestre
 * @property int|null $ano
 * @property int $professor_id
 * @property int $disciplina_id
 * @property int $coordenacao_id
 *
 * @property Coordenacao $coordenacao
 * @property Disciplina $disciplina
 * @property Professor $professor
 * @property TurmaAluno[] $turmaAlunos
 */
class Turma extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'turma';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'professor_id', 'disciplina_id', 'coordenacao_id'], 'required'],
            [['semestre', 'ano', 'professor_id', 'disciplina_id', 'coordenacao_id'], 'default', 'value' => null],
            [['semestre', 'ano', 'professor_id', 'disciplina_id', 'coordenacao_id'], 'integer'],
            [['nome'], 'string', 'max' => 255],
            [['coordenacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Coordenacao::className(), 'targetAttribute' => ['coordenacao_id' => 'id']],
            [['disciplina_id'], 'exist', 'skipOnError' => true, 'targetClass' => Disciplina::className(), 'targetAttribute' => ['disciplina_id' => 'id']],
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
            'nome' => 'Nome',
            'semestre' => 'Semestre',
            'ano' => 'Ano',
            'professor_id' => 'Professor ID',
            'disciplina_id' => 'Disciplina ID',
            'coordenacao_id' => 'Coordenacao ID',
        ];
    }

    /**
     * Gets query for [[Coordenacao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoordenacao()
    {
        return $this->hasOne(Coordenacao::className(), ['id' => 'coordenacao_id']);
    }

    /**
     * Gets query for [[Disciplina]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplina()
    {
        return $this->hasOne(Disciplina::className(), ['id' => 'disciplina_id']);
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
     * Gets query for [[TurmaAlunos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurmaAlunos()
    {
        return $this->hasMany(TurmaAluno::className(), ['turma_id' => 'id']);
    }
}
