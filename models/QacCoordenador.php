<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qac_coordenador".
 *
 * @property int $id
 * @property int|null $nota
 * @property int|null $semestre
 * @property int|null $ano
 * @property int $aluno_id
 * @property int $pergunta_id
 * @property int $coordenacao_id
 *
 * @property Aluno $aluno
 * @property Turma $coordenacao
 * @property QacCoordenadorPerguntum $pergunta
 */
class QacCoordenador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'qac_coordenador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nota', 'semestre', 'ano', 'aluno_id', 'pergunta_id', 'coordenacao_id'], 'default', 'value' => null],
            [['nota', 'semestre', 'ano', 'aluno_id', 'pergunta_id', 'coordenacao_id'], 'integer'],
            [['aluno_id', 'pergunta_id', 'coordenacao_id'], 'required'],
            [['aluno_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['aluno_id' => 'id']],
            [['pergunta_id'], 'exist', 'skipOnError' => true, 'targetClass' => QacCoordenadorPerguntum::className(), 'targetAttribute' => ['pergunta_id' => 'id']],
            [['coordenacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Turma::className(), 'targetAttribute' => ['coordenacao_id' => 'id']],
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
            'semestre' => 'Semestre',
            'ano' => 'Ano',
            'aluno_id' => 'Aluno ID',
            'pergunta_id' => 'Pergunta ID',
            'coordenacao_id' => 'Coordenacao ID',
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
     * Gets query for [[Coordenacao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoordenacao()
    {
        return $this->hasOne(Turma::className(), ['id' => 'coordenacao_id']);
    }

    /**
     * Gets query for [[Pergunta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPergunta()
    {
        return $this->hasOne(QacCoordenadorPerguntum::className(), ['id' => 'pergunta_id']);
    }
}
