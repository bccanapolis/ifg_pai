<?php

namespace app\models;

use Yii;

/**
 * This is the base model class for table "notas_disciplina".
 *
 * @property integer $id
 * @property integer $id_aluno
 * @property integer $id_disciplina
 *
 * @property \app\models\Aluno $aluno
 * @property \app\models\Disciplina $disciplina
 */
class NotasDisciplina extends \yii\db\ActiveRecord
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
            [['id_aluno', 'id_disciplina'], 'required'],
            [['id_aluno', 'id_disciplina'], 'default', 'value' => null],
            [['id_aluno', 'id_disciplina'], 'integer'],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['id_aluno' => 'id']],
            [['id_disciplina'], 'exist', 'skipOnError' => true, 'targetClass' => Disciplina::className(), 'targetAttribute' => ['id_disciplina' => 'id']],        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notas_disciplina';
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
            'id_aluno' => 'Id Aluno',
            'id_disciplina' => 'Disciplina',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAluno()
    {
        return $this->hasOne(\app\models\Aluno::className(), ['id' => 'id_aluno']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplina()
    {
        return $this->hasOne(\app\models\Disciplina::className(), ['id' => 'id_disciplina']);
    }
}
