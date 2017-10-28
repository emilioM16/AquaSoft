<?php
namespace app\models\form;

use app\models\conditions\EnviromentalConditions;
use app\models\Parcel;
use Yii;
use yii\base\Model;
use yii\widgets\ActiveForm;

class ControlForm extends Model
{
    private $_conditions;
    private $_supplies;

    public function rules(){
        return [
            [['Conditions'],'required'],
            [['Supplies'],'safe'],
        ];
    }

    
}