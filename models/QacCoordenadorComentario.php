<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qac_coordenador_comentario".
 *
 * @property int $id
 * @property string|null $texto
 * @property int|null $semestre
 * @property int|null $ano
 * @property int $coordenacao_id
 *
 * @property Coordenacao $coordenacao
 */
class QacCoordenadorComentario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'qac_coordenador_comentario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['texto'], 'string'],
            [['semestre', 'ano', 'coordenacao_id'], 'default', 'value' => null],
            [['semestre', 'ano', 'coordenacao_id'], 'integer'],
            [['coordenacao_id'], 'required'],
            [['coordenacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Coordenacao::className(), 'targetAttribute' => ['coordenacao_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'texto' => 'Texto',
            'semestre' => 'Semestre',
            'ano' => 'Ano',
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
}
