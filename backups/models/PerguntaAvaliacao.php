<?php

namespace app\models;

use Yii;

/**
 * This is the base model class for table "pergunta_avaliacao".
 *
 * @property integer $id
 * @property string $enunciado
 * @property integer $id_disciplina
 *
 * @property \app\models\Avaliacao[] $avaliacaos
 * @property \app\models\Disciplina $disciplina
 */
class PerguntaAvaliacao extends \yii\db\ActiveRecord
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
        return 'pergunta_avaliacao';
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
    public function getAvaliacaos()
    {
        return $this->hasMany(\app\models\Avaliacao::className(), ['id_pergunta_avaliacao' => 'id']);
    }
}
