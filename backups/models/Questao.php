<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the base model class for table "questao".
 *
 * @property integer $id
 * @property string $enunciado
 * @property integer $id_disciplina
 * @property string $imagem
 *
 * @property \app\models\Alternativa[] $alternativas
 * @property \app\models\Disciplina $disciplina
 */
class Questao extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $arquivo;

    public function behaviors(){
        return [
            [
                'class' => '\yiidreamteam\upload\FileUploadBehavior',
                'attribute' => 'arquivo',
                'filePath' => '@webroot/uploads/questao/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/questao/[[pk]].[[extension]]',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_disciplina'], 'required'],
            ['enunciado', 'required', 'when' => function ($model) {
                return is_null($model->arquivo) || $model->arquivo == "";
            },],
            [['enunciado', 'imagem'], 'string'],
            [['id_disciplina'], 'default', 'value' => null],
            [['id_disciplina'], 'integer'],
            [['id_disciplina'], 'exist', 'skipOnError' => true, 'targetClass' => Disciplina::className(), 'targetAttribute' => ['id_disciplina' => 'id']],            
            ['arquivo', 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questao';
    }

    /**
    * @inheritdoc
    */
    public static function representingColumn()
    {
        return 'enunciado';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enunciado' => 'Enunciado',
            'id_disciplina' => 'Disciplina',
            'arquivo' => 'Imagem',
            'imagem' => 'Imagem',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlternativas()
    {
        return $this->hasMany(\app\models\Alternativa::className(), ['id_questao' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplina()
    {
        return $this->hasOne(\app\models\Disciplina::className(), ['id' => 'id_disciplina']);
    }

    /**
     * Creates and populates a set of models.
     *
     * @param string $modelClass
     * @param array $multipleModels
     * @return array
     */
    public static function createMultiple($modelClass, $multipleModels = [])
    {
        $model    = new $modelClass;
        $formName = $model->formName();
        $post     = Yii::$app->request->post($formName);
        $models   = [];

        if (! empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                    $models[] = $multipleModels[$item['id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }

    public function validateQuestion($attribute, $params, $validator)
    {
        if (!$this->imagem || $this->imagem == "" || $this->imagem == null){
            $this->addError($attribute, "É necessário adicionar enunciado.");
        }
    }
}
