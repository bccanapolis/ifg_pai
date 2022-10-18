<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qac_professor_comentario".
 *
 * @property int $id
 * @property string|null $texto
 * @property int $turma_id
 *
 * @property Turma $turma
 */
class QacProfessorComentario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'qac_professor_comentario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['texto'], 'string'],
            [['turma_id'], 'required'],
            [['turma_id'], 'default', 'value' => null],
            [['turma_id'], 'integer'],
            [['turma_id'], 'exist', 'skipOnError' => true, 'targetClass' => Turma::className(), 'targetAttribute' => ['turma_id' => 'id']],
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
            'turma_id' => 'Turma ID',
        ];
    }

    /**
     * Gets query for [[Turma]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurma()
    {
        return $this->hasOne(Turma::className(), ['id' => 'turma_id']);
    }
}
