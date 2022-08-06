<?php

namespace app\models;

use Yii;

/**
 * This is the base model class for table "aluno".
 *
 * @property integer $id
 * @property string $primeiro_nome
 * @property string $ultimo_nome
 * @property string $matricula
 * @property string $cpf
 * @property integer $user_id
 *
 * @property \app\models\User $user
 * @property \app\models\AlunoDisciplina[] $alunoDisciplinas
 * @property \app\models\Avaliacao[] $avaliacaos
 * @property \app\models\Resposta[] $respostas
 */
class Aluno extends \yii\db\ActiveRecord
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
            [['primeiro_nome', 'matricula', 'user_id'], 'required'],
            [['user_id'], 'default', 'value' => null],
            [['user_id'], 'integer'],
            [['primeiro_nome', 'ultimo_nome', 'matricula', 'cpf'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['cpf', \yiibr\brvalidator\CpfValidator::className()],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aluno';
    }

    /**
     * @inheritdoc
     */
    public static function representingColumn()
    {
        return 'matricula';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'primeiro_nome' => 'Primeiro Nome',
            'ultimo_nome' => 'Último Nome',
            'matricula' => 'Matrícula',
            'cpf' => 'CPF',
            'user_id' => 'User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlunoDisciplinas()
    {
        return $this->hasMany(\app\models\AlunoDisciplina::className(), ['id_aluno' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacaos()
    {
        return $this->hasMany(\app\models\Avaliacao::className(), ['id_aluno' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespostas()
    {
        return $this->hasMany(\app\models\Resposta::className(), ['id_aluno' => 'id']);
    }

    public function getAcertosAdd()
    {
        $countCorretas = 0;
        $totalPerguntas = 0;
        $aluno_id = $this->id;

        $year = date('Y');
        $semestre = ((date('m') <= 7) ? 1 : 2);

        $respostasAluno = Resposta::find()->innerJoin('questao', 'resposta.id_questao = questao.id')
            ->innerJoin('disciplina', 'disciplina.id = questao.id_disciplina')
            ->where(['resposta.id_aluno' => $aluno_id])
            ->andWhere(['disciplina.ano' => $year])
            ->andWhere(['disciplina.semestre' => $semestre])->all();

        $countCorretas = 0;

        foreach ($respostasAluno as $resposta) {
            $alternativa = $resposta->alternativa;
            if ($alternativa->correta == true) {
                $countCorretas++;
            }
        }

        return $countCorretas;
    }
}
