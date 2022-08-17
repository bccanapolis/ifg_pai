<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the base model class for table "disciplina".
 *
 * @property integer $id
 * @property string $nome
 * @property integer $ano
 * @property integer $semestre
 * @property integer $id_professor
 * @property integer $id_disciplina_matriz
 *
 * @property \app\models\AlunoDisciplina[] $alunoDisciplinas
 * @property \app\models\Professor $professor
 * @property \app\models\DisciplinaMatriz $disciplinaMatriz
 * @property \app\models\PerguntaAvaliacao[] $perguntaAvaliacaos
 * @property \app\models\Questao[] $questaos
 */
class Disciplina extends ModelBase
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
            [['nome', 'ano', 'semestre', 'id_professor', 'id_disciplina_matriz'], 'required'],
            [['nome'], 'string'],
            [['ano', 'semestre', 'id_professor', 'id_disciplina_matriz'], 'default', 'value' => null],
            [['ano', 'semestre', 'id_professor', 'id_disciplina_matriz'], 'integer'],
//            [['ano', 'semestre'], 'unique', 'targetAttribute' => ['ano', 'semestre']],
//            [['id_professor'], 'unique'],
            [['id_professor'], 'exist', 'skipOnError' => true, 'targetClass' => Professor::className(), 'targetAttribute' => ['id_professor' => 'id']],
            [['id_disciplina_matriz'], 'exist', 'skipOnError' => true, 'targetClass' => DisciplinaMatriz::className(), 'targetAttribute' => ['id_disciplina_matriz' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'disciplina';
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
            'ano' => 'Ano',
            'semestre' => 'Semestre',
            'id_professor' => 'Professor',
            'id_disciplina_matriz' => 'Disciplina Grade',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlunoDisciplinas()
    {
        return $this->hasMany(\app\models\AlunoDisciplina::className(), ['id_disciplina' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfessor()
    {
        return $this->hasOne(\app\models\Professor::className(), ['id' => 'id_professor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplinaMatriz()
    {
        return $this->hasOne(\app\models\DisciplinaMatriz::className(), ['id' => 'id_disciplina_matriz']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerguntaAvaliacaos()
    {
        return $this->hasMany(\app\models\PerguntaAvaliacao::className(), ['id_disciplina' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestaos()
    {
        return $this->hasMany(\app\models\Questao::className(), ['id_disciplina' => 'id']);
    }
}
