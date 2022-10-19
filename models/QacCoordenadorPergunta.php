<?php

namespace app\models;

/**
 * This is the model class for table "qac_coordenador_pergunta".
 *
 * @property int $id
 * @property string|null $enunciado
 * @property int $curso_id
 *
 * @property Curso $curso
 * @property QacCoordenador[] $qacCoordenadors
 */
class QacCoordenadorPergunta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'qac_coordenador_pergunta';
    }

    public static function representingColumn()
    {
        return 'enunciado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enunciado'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enunciado' => 'Enunciado',
        ];
    }

    /**
     * Gets query for [[QacCoordenadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQacCoordenadors()
    {
        return $this->hasMany(QacCoordenador::className(), ['pergunta_id' => 'id']);
    }
}
