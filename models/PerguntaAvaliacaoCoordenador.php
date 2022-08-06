<?php

namespace app\models;

use Yii;

/**
 * This is the base model class for table "pergunta_avaliacao".
 *
 * @property integer $id
 * @property string $enunciado
 *
 * @property \app\models\Avaliacao[] $avaliacaos
 */
class PerguntaAvaliacaoCoordenador extends \yii\db\ActiveRecord
{

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
            [['enunciado'], 'required'],
            [['enunciado'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pergunta_avaliacao_coordenador';
    }

    /**
     * @inheritdoc
     */
    public static function representingColumn()
    {
        return 'enunciado';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enunciado' => 'Enunciado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacaosCoordenador()
    {
        return $this->hasMany(\app\models\AvaliacaoCoordenador::className(), ['id_pergunta_avaliacao_coordenador' => 'id']);
    }
}
