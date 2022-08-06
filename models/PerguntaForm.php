<?php
namespace app\models;


use Yii;
use yii\base\Model;
use yii\widgets\ActiveForm;

class PerguntaForm extends Model
{
    public $_parcels;

    public function rules()
    {
        return [
            [['Parcels'], 'safe'],
        ];
    }

    public function afterValidate()
    {
        if (!Model::validateMultiple($this->getAllModels())) {
            $this->addError(null); // add an empty error to prevent saving
        }
        parent::afterValidate();
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $transaction = Yii::$app->db->beginTransaction();
        if (!$this->saveParcels()) {
            $transaction->rollBack();
            return false;
        }
        $transaction->commit();
        return true;
    }

    public function saveParcels()
    {
        $keep = [];
        foreach ($this->parcels as $parcel) {
            if (!$parcel->save(false)) {
                return false;
            }
            $keep[] = $parcel->id;
        }
        $query = PerguntaAvaliacao::find();
        if ($keep) {
            $query->andWhere(['not in', 'id', $keep]);
        }
        foreach ($query->all() as $parcel) {
            $parcel->delete();
        }
        return true;
    }



    public function getParcels()
    {
        if ($this->_parcels === null) {
            $this->_parcels = \app\models\PerguntaAvaliacao::find()->all();
        }
        return $this->_parcels;
    }

    private function getParcel($key)
    {
        $parcel = $key && strpos($key, 'new') === false ? PerguntaAvaliacao::findOne($key) : false;
        if (!$parcel) {
            $parcel = new PerguntaAvaliacao();
            $parcel->loadDefaultValues();
        }
        return $parcel;
    }

    public function setParcels($parcels)
    {
        unset($parcels['__id__']); // remove the hidden "new Parcel" row
        $this->_parcels = [];
        foreach ($parcels as $key => $parcel) {
            if (is_array($parcel)) {
                $this->_parcels[$key] = $this->getParcel($key);
                $this->_parcels[$key]->setAttributes($parcel);
            } elseif ($parcel instanceof PerguntaAvaliacao) {
                $this->_parcels[$parcel->id] = $parcel;
            }
        }
    }

    public function errorSummary($form)
    {
        $errorLists = [];
        foreach ($this->getAllModels() as $id => $model) {
            $errorList = $form->errorSummary($model, [
                'header' => '<p>Please fix the following errors for <b>' . $id . '</b></p>',
            ]);
            $errorList = str_replace('<li></li>', '', $errorList); // remove the empty error
            $errorLists[] = $errorList;
        }
        return implode('', $errorLists);
    }

    private function getAllModels()
    {
        $models = [];
        foreach ($this->parcels as $id => $parcel) {
            $models['Parcel.' . $id] = $this->parcels[$id];
        }
        return $models;
    }
}
