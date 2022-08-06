<?php

namespace app\models;

use Yii;

/**
 * This is the base model class for table "resposta".
 *
 * @property integer $id
 * @property integer $id_aluno
 * @property integer $id_alternativa
 * @property integer $id_questao
 *
 * @property \app\models\Alternativa $alternativa
 * @property \app\models\Aluno $aluno
 * @property \app\models\Questao $questao
 */
class Resposta extends \yii\db\ActiveRecord
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
            [['id_aluno', 'id_alternativa', 'id_questao'], 'required'],
            [['id_aluno', 'id_alternativa'], 'default', 'value' => null],
            [['id_aluno', 'id_alternativa', 'id_questao'], 'integer'],
            [['id_alternativa'], 'exist', 'skipOnError' => true, 'targetClass' => Alternativa::className(), 'targetAttribute' => ['id_alternativa' => 'id']],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['id_aluno' => 'id']],
            [['id_questao'], 'exist', 'skipOnError' => true, 'targetClass' => Questao::className(), 'targetAttribute' => ['id_questao' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resposta';
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
            'id_aluno' => 'Aluno',
            'id_alternativa' => 'Alternativas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlternativa()
    {
        return $this->hasOne(\app\models\Alternativa::className(), ['id' => 'id_alternativa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAluno()
    {
        return $this->hasOne(\app\models\Aluno::className(), ['id' => 'id_aluno']);
    }
}
