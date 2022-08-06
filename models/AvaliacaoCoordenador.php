<?php

namespace app\models;

use Yii;

/**
 * This is the base model class for table "avaliacao".
 *
 * @property integer $id
 * @property integer $nota
 * @property integer $id_aluno
 * @property integer $id_pergunta_avaliacao_coordenador
 * @property integer $ano
 * @property integer $semestre
 * @property integer $comentario
 *
 * @property \app\models\Aluno $aluno
 * @property \app\models\PerguntaAvaliacaoCoordenador $perguntaAvaliacaoCoordenador
 */
class AvaliacaoCoordenador extends \yii\db\ActiveRecord
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
            [['nota', 'id_aluno', 'id_pergunta_avaliacao_coordenador'], 'required'],
            [['nota', 'id_aluno', 'id_pergunta_avaliacao_coordenador'], 'default', 'value' => null],
            [['nota', 'id_aluno', 'id_pergunta_avaliacao_coordenador'], 'integer'],
            [['ano', 'semestre'], 'safe'],
            [['ano', 'semestre'], 'integer'],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['id_aluno' => 'id']],
            [['id_pergunta_avaliacao_coordenador'], 'exist', 'skipOnError' => true, 'targetClass' => PerguntaAvaliacaoCoordenador::className(), 'targetAttribute' => ['id_pergunta_avaliacao_coordenador' => 'id']],];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'avaliacao_coordenador';
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
    public function getPerguntaAvaliacaoCoordenador()
    {
        return $this->hasOne(\app\models\PerguntaAvaliacaoCoordenador::className(), ['id' => 'id_pergunta_avaliacao_coordenador']);
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
