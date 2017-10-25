<?php

namespace app\models\census;

use Yii;
use app\models\aquarium\Aquarium;
use app\models\aquarium\AquariumSearch;
use app\models\specie\Specie;
use yii\helpers\ArrayHelper;


class Census
{

    public static function getAvailableAquariums(){ //devuelve todos los acuarios asignados al usuario y que contengan al menos un ejemplar de cualquier especie//
        $searchModel  = new AquariumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $aquariums = $dataProvider->getModels();

        foreach ($aquariums as $key => $aquarium) {
            $aquariumSpecies = $aquarium->getQuantityBySpecie();;
            if(empty($aquariumSpecies)){ //si NO hay especies en ese acuario, lo elimina//
                unset($aquariums[$key]);
            }
        }
        $aquariums = array_values($aquariums);
        return $aquariums;
    }



    public static function getAllAquariumsData(){
        $searchModel  = new AquariumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $aquariums = $dataProvider->getModels();
        $data = [];
        $species = Specie::find()->select(['nombre'])->all();

        foreach ($aquariums as $key => $aquarium) {
            // yii::error(\yii\helpers\VarDumper::dumpAsString($aquarium->nombre));
            $aquariumSpecies = $aquarium->getQuantityBySpecie(); //obtiene las especies que posee el acuario actual//
            foreach ($aquariumSpecies as $key => $aqSpecie) {
                $specieNotFound = '';
                foreach ($species as $key => $specie) {
                    $specieNotFound = $specie->nombre;
                    $as = ArrayHelper::map($aquariumSpecies, 'idEspecie','nombre');
                    if(in_array($specie->nombre,$as)){
                        $data[$aquarium->nombre][$aqSpecie['nombre']] = (int)$aqSpecie['cantidad']; 
                    }else{
                        $data[$aquarium->nombre][$specieNotFound] = 0;
                    }
                }
            }
        }
        return $data;
    }


    public static function getFormattedData(){
        $originalData = static::getAllAquariumsData();
        $categories = [];
        $series = [];
        foreach ($originalData as $aquariumName => $aquariumData) {

            $categories[] = $aquariumName;

            foreach ($aquariumData as $specieName => $quantity) {
 
                $found = false;
                for ($i = 0; $i < sizeof($series); $i++) {
                    if($specieName == $series[$i]['name']){//si el nombre de la especie es encontrado en el arreglo $series //
                        $found = true;
                        $targetSeries = $series[$i];
                        unset($series[$i]);
                           $series = array_values($series);
                    }                   
                }
                if(!$found){
                    $targetSeries = ['name'=>$specieName, 'data'=>[]];
                }
                $targetSeries['data'][]= $quantity;
                $series[] = $targetSeries;
            }         
        }
        $series = array_values($series);
        $censusData[] = $categories;
        $censusData[] = $series;
        return $censusData;
    }

}
