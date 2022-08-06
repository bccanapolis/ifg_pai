<?php

namespace app\models;

use Yii;

/**
 * This is the base model class for table "alternativa".
 *
 * @property integer $id
 * @property string $descricao
 * @property boolean $correta
 * @property integer $id_questao
 *
 * @property \app\models\Questao $questao
 * @property \app\models\Resposta $resposta
 */
class Alternativa extends \yii\db\ActiveRecord
{

    public function behaviors(){
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao', 'correta'], 'required'],
            [['descricao'], 'string'],
            [['correta'], 'boolean'],
            [['id_questao'], 'default', 'value' => null],
            [['id_questao'], 'integer'],
            [['id_questao'], 'unique'],
            [['id_questao'], 'exist', 'skipOnError' => true, 'targetClass' => Questao::className(), 'targetAttribute' => ['id_questao' => 'id']],        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alternativa';
    }

    /**
    * @inheritdoc
    */
    public static function representingColumn()
    {
        return 'descricao';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descrição',
            'correta' => 'Correta',
            'id_questao' => 'Questão',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestao()
    {
        return $this->hasOne(\app\models\Questao::className(), ['id' => 'id_questao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResposta()
    {
        return $this->hasOne(\app\models\Resposta::className(), ['id_alternativa' => 'id']);
    }
}
