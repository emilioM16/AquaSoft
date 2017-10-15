<?php

namespace app\models\specie;

use Yii;
use app\models\specimen\Specimen;
use app\models\aquarium\Aquarium;


use app\models\aquarium\AquariumSearch;
/**
 * This is the model class for table "ESPECIE".
 *
 * @property integer $idEspecie
 * @property string $nombre
 * @property string $descripcion
 * @property double $minPH
 * @property double $maxPH
 * @property double $minTemp
 * @property double $maxTemp
 * @property double $minSalinidad
 * @property double $maxSalinidad
 * @property double $minLux
 * @property double $maxLux
 * @property integer $minEspacio
 * @property double $minCO2
 * @property double $maxCO2
 * @property integer $activo
 *
 * @property Specimen[] $eJEMPLARs
 * @property Aquarium[] $acuarioIdAcuarios
 */
class Specie extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ESPECIE';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'minPH', 'maxPH', 'minTemp', 'maxTemp', 'minSalinidad', 'maxSalinidad', 'minLux', 'maxLux', 'minEspacio', 'minCO2', 'maxCO2'], 'required'],
            [['minPH', 'maxPH', 'minTemp', 'maxTemp', 'minSalinidad', 'maxSalinidad', 'minLux', 'maxLux', 'minCO2', 'maxCO2'], 'number'],
            [['minEspacio', 'activo'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idEspecie' => 'Id Especie',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'minPH' => 'Min Ph',
            'maxPH' => 'Max Ph',
            'minTemp' => 'Min Temp',
            'maxTemp' => 'Max Temp',
            'minSalinidad' => 'Min Salinidad',
            'maxSalinidad' => 'Max Salinidad',
            'minLux' => 'Min Lux',
            'maxLux' => 'Max Lux',
            'minEspacio' => 'Min Espacio',
            'minCO2' => 'Min Co2',
            'maxCO2' => 'Max Co2',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecimens()
    {
        return $this->hasMany(Specimen::className(), ['especie_idEspecie' => 'idEspecie']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuarioIdAcuarios()
    {
        return $this->hasMany(Aquarium::className(), ['idAcuario' => 'acuario_idAcuario'])->viaTable('EJEMPLAR', ['especie_idEspecie' => 'idEspecie']);
    }

    public static function calculatePorcentageBySpecie($quantity){
        $porcentages = [];
        foreach ($quantity as $key => $value) {
            $porcentages[] = [$value['nombre'],(int)$value['cantidad']];
        }
        return $porcentages;
    }



    private function validConditions($aquarium){ //evalúa las condiciones ambientales de un determinado acuario//
        $actualConditions = $aquarium->getActualConditions();
        
        if(($this->minPH <= $actualConditions['ph']) && ($actualConditions['ph'] <= $this->maxPH)){ 
            if(($this->minTemp <= $actualConditions['temperatura']) && ($actualConditions['temperatura'] <= $this->maxTemp)){
                if(($this->minSalinidad <= $actualConditions['salinidad']) && ($actualConditions['salinidad'] <= $this->maxSalinidad)){
                    if(($this->minLux <= $actualConditions['lux']) && ($actualConditions['lux'] <= $this->maxLux)){
                        if(($this->minCO2 <= $actualConditions['CO2']) && ($actualConditions['CO2'] <= $this->maxCO2)){
                            return true;
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    public function getCompatibleAquariums(){
        $searchModel  = new AquariumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $aquariums = $dataProvider->getModels();

        foreach ($aquariums as $key => $aquarium) {
            if($aquarium->espacioDisponible < $this->minEspacio){ //si el espacio no es sufiente, se descarta ese acuario//
                unset($aquariums[$key]); //elimina el item del arreglo//
            }else{ //si hay espacio, se evalúan las condiciones ambientales//                    
                if(!$this->validConditions($aquarium)){ //las condiciones ambientales del acuario NO son adecuadas para la especie seleccionada//
                    unset($aquariums[$key]); //elimina el item del arreglo//
                }
            }
        }
        $aquariums = array_values($aquariums); //vuelve a asignar los indices a los elementos//
        return $aquariums;
    }

}
