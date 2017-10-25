<?php

namespace app\models\conditions;

use Yii;
use app\models\aquarium\Aquarium;
use app\models\task\Task;


/**
 * This is the model class for table "CONDICION_AMBIENTAL".
 *
 * @property integer $idCondicionAmbiental 
 * @property double $temperatura
 * @property double $ph
 * @property double $salinidad
 * @property double $lux
 * @property double $CO2
 * @property integer $acuario_idAcuario
 * @property integer $tarea_idTarea
 *
 * @property Aquarium $acuarioIdAcuario
 * @property Task $tareaIdTarea
 */
class EnviromentalConditions extends \yii\db\ActiveRecord
{
    public $maxPh;
    public $minPh;
    public $maxTemp;
    public $minTemp;
    public $maxSal;
    public $minSal;
    public $maxLux;
    public $minLux;
    public $maxCO2;
    public $minCO2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'CONDICION_AMBIENTAL';
    }

    public function inicialice($idTarea, $idAcuario){
        $this->tarea_idTarea = $idTarea;
        $this->acuario_idAcuario = $idAcuario;
        $this->loadValuesMaxMin();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ph', 'temperatura', 'salinidad', 'lux', 'CO2', 'acuario_idAcuario', 'tarea_idTarea'], 'required'],
            [['ph', 'temperatura', 'salinidad', 'lux', 'CO2'], 'number'],
            [['acuario_idAcuario', 'tarea_idTarea'], 'integer'],
            [['acuario_idAcuario'], 'exist', 'skipOnError' => true, 'targetClass' => Aquarium::className(), 'targetAttribute' => ['acuario_idAcuario' => 'idAcuario']],
            [['tarea_idTarea'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['tarea_idTarea' => 'idTarea']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCondicionAmbiental' => 'Id Condicion Ambiental',
            'ph' => 'Ph',
            'temperatura' => 'Temperatura',
            'salinidad' => 'Salinidad',
            'lux' => 'Lux',
            'CO2' => 'Co2',
            'acuario_idAcuario' => 'Acuario Id Acuario',
            'tarea_idTarea' => 'Tarea Id Tarea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuarioIdAcuario()
    {
        return $this->hasOne(Aquarium::className(), ['idAcuario' => 'acuario_idAcuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareaIdTarea()
    {
        return $this->hasOne(Task::className(), ['idTarea' => 'tarea_idTarea']);
    }

    public function loadValuesMaxMin(){
        // $species = Specie::find()
        //             ->asArray()
        //             ->select(['idEspecie','nombre','cantidad'])
        //             ->joinWith('specimens')
        //             ->where(['acuario_idAcuario'=>$this->acuario_idAcuario])
        //             ->all();
        // foreach ($species as $specie) {
        //     # code...d
        // }
        // if ($acuario !== null){

        // } 
    }

    public static function getSuffix($name){
        switch ($name) {
            case 'temperatura':
                return '°C';
                break;
            case 'ph':
                return '';
            case 'CO2':
                return 'mg/l';
            case 'salinidad':
                return 'g/L';
            case 'lux':
                return 'lx';
            default:
                break;
        }
    }
}
