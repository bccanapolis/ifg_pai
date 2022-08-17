<?php

namespace app\models;

use Yii;

/**
 * This is the base model class for table "comentario_avaliacao".
 *
 * @property integer $id
 * @property string $texto
 * @property integer $id_disciplina
 *
 * @property \app\models\Disciplina $disciplina
 */
class ComentarioAvaliacao extends \yii\db\ActiveRecord
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
            [['texto'], 'string'],
            [['id_disciplina'], 'required'],
            [['id_disciplina'], 'default', 'value' => null],
            [['id_disciplina'], 'integer'],
            [['id_disciplina'], 'exist', 'skipOnError' => true, 'targetClass' => Disciplina::className(), 'targetAttribute' => ['id_disciplina' => 'id']],
            [['ano', 'semestre'], 'required'],
            [['ano', 'semestre'], 'default', 'value' => null],
            [['ano', 'semestre'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comentario_avaliacao';
    }

    /**
     * @inheritdoc
     */
    public static function representingColumn()
    {
        return 'texto';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'texto' => 'Suas observações e comentários adicionais:',
            'id_disciplina' => 'Id Disciplina',
            'ano' => 'Ano',
            'semestre' => 'Semestre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplina()
    {
        return $this->hasOne(\app\models\Disciplina::className(), ['id' => 'id_disciplina']);
    }
}
