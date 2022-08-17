<?php

namespace app\models;

use Yii;

/**
 * This is the base model class for table "avaliacao".
 *
 * @property integer $id
 * @property integer $nota
 * @property integer $id_aluno
 * @property integer $id_pergunta_avaliacao
 * @property integer $id_disciplina
 *
 * @property \app\models\Aluno $aluno
 * @property \app\models\Disciplina $disciplina
 * @property \app\models\PerguntaAvaliacao $perguntaAvaliacao
 */
class Avaliacao extends \yii\db\ActiveRecord
{
    public $comentario;

    public function behaviors()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nota', 'id_aluno', 'id_pergunta_avaliacao'], 'required'],
            [['nota', 'id_aluno', 'id_pergunta_avaliacao', 'id_disciplina'], 'default', 'value' => null],
            [['nota', 'id_aluno', 'id_pergunta_avaliacao', 'id_disciplina'], 'integer'],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['id_aluno' => 'id']],
            [['id_disciplina'], 'exist', 'skipOnError' => true, 'targetClass' => Disciplina::className(), 'targetAttribute' => ['id_disciplina' => 'id']],
            [['id_pergunta_avaliacao'], 'exist', 'skipOnError' => true, 'targetClass' => PerguntaAvaliacao::className(), 'targetAttribute' => ['id_pergunta_avaliacao' => 'id']],];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'avaliacao';
    }

    /**
     * @inheritdoc
     */
    public static function representingColumn()
    {
        return 'id';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nota' => 'Nota',
            'id_aluno' => 'Aluno',
            'id_pergunta_avaliacao' => 'Pergunta Avaliação',
            'id_disciplina' => 'Disciplina',
            'comentario' => 'Comentários',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAluno()
    {
        return $this->hasOne(\app\models\Aluno::className(), ['id' => 'id_aluno']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplina()
    {
        return $this->hasOne(\app\models\Disciplina::className(), ['id' => 'id_disciplina']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerguntaAvaliacao()
    {
        return $this->hasOne(\app\models\PerguntaAvaliacao::className(), ['id' => 'id_pergunta_avaliacao']);
    }

    public static function getNotas()
    {
        return [
            0 => "Péssima",
            1 => "Ruim",
            2 => "Regular",
            3 => "Boa",
            4 => "Excelente",
        ];
    }
}
