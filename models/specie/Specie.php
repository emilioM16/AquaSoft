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
            [['descripcion'], 'string', 'max' => 400],
            [ ['nombre'], 'unique', 'when' => function ($model, $attribute) {
                return $model->{$attribute} !== static::findOne($model->idEspecie)->$attribute; },
                'on' => 'update',
                'message'=>'El nombre ingresado ya existe'], //en caso de ser una modificación de datos
            [['nombre'], 'unique', 'on' => 'create', 'message'=>'El nombre ingresado ya existe'], //en caso de crear una nueva especie
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
            'descripcion' => 'Descripción',
            'minPH' => 'pH mínimo',
            'maxPH' => 'pH máximo',
            'minTemp' => 'Temperatura mínima',
            'maxTemp' => 'Temperatura máxima',
            'minSalinidad' => 'Salinidad mínima',
            'maxSalinidad' => 'Salinidad máxima',
            'minLux' => 'Lux mínimo',
            'maxLux' => 'Lux máximo',
            'minEspacio' => 'Espacio requerido',
            'minCO2' => 'Co2 mínimo',
            'maxCO2' => 'Co2 máximo',
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



    public function validConditions($aquarium){ //evalúa las condiciones ambientales de un determinado acuario//
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


    //Obtiene los acuarios que son compatibles con la especie actual//
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
                }else{
                    $aquariums[$key]->maxQuantity = floor($aquarium->espacioDisponible / $this->minEspacio);
                }
            }
        }
        $aquariums = array_values($aquariums); //vuelve a asignar los indices a los elementos//
        return $aquariums;
    }



    public function getAvailableAquariums(){ //retorna los acuarios que contengan al menos un ejemplar de la especie seleccionada//
        $searchModel  = new AquariumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $aquariums = $dataProvider->getModels();

        foreach ($aquariums as $key => $aquarium) {
            $aquariumQuantity = $aquarium->getQuantity($this->idEspecie);
            if($aquariumQuantity <= 0 ){ // verifica que exista un registro en la tabla ejemplares y que exista al menos un ejemplar en el acuario //
                unset($aquariums[$key]);
            }else{
                $aquariums[$key]->maxQuantity = $aquariumQuantity;
            }
        }
        $aquariums = array_values($aquariums);
        return $aquariums;
    }



}
