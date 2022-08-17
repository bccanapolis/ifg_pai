<?php

namespace app\models;

use Yii;

/**
 * This is the base model class for table "comentario_avaliacao_coordenador".
 *
 * @property integer $id
 * @property string $texto
 * @property integer $ano
 * @property integer $semestre
 */
class ComentarioAvaliacaoCoordenador extends \yii\db\ActiveRecord
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
            [['texto'], 'string'],
            [['ano', 'semestre'], 'required'],
            [['ano', 'semestre'], 'default', 'value' => null],
            [['ano', 'semestre'], 'integer'],        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comentario_avaliacao_coordenador';
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
            'ano' => 'Ano',
            'semestre' => 'Semestre',
        ];
    }
}
