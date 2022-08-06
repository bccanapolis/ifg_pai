<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the base model class for table "disciplina".
 *
 * @property integer $id
 * @property string $nome
 *
 */
class DisciplinaMatriz extends ModelBase
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
            [['nome'], 'required'],
            [['sigla'], 'safe'],
            [['nome', 'sigla'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'disciplina_matriz';
    }

    /**
     * @inheritdoc
     */
    public static function representingColumn()
    {
        return 'nome';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'sigla' => 'Sigla'
        ];
    }
}
