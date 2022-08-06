<?php

namespace app\models;

use Yii;

/**
 * This is the base model class for table "aluno_disciplina".
 *
 * @property integer $id
 * @property integer $id_disciplina
 * @property integer $id_aluno
 *
 * @property \app\models\Aluno $aluno
 * @property \app\models\Disciplina $disciplina
 */
class AlunoDisciplina extends \yii\db\ActiveRecord
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
            [['id_disciplina', 'id_aluno'], 'required'],
            [['id_disciplina', 'id_aluno'], 'default', 'value' => null],
            [['id_disciplina', 'id_aluno'], 'integer'],
            [['id_disciplina', 'id_aluno'], 'unique', 'targetAttribute' => ['id_disciplina', 'id_aluno']],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['id_aluno' => 'id']],
            [['id_disciplina'], 'exist', 'skipOnError' => true, 'targetClass' => Disciplina::className(), 'targetAttribute' => ['id_disciplina' => 'id']],        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aluno_disciplina';
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
            'id_disciplina' => 'Disciplina',
            'id_aluno' => 'Aluno',
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
