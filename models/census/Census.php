<?php

namespace app\models\census;

use Yii;
use app\models\aquarium\Aquarium;
use app\models\aquarium\AquariumSearch;
use app\models\specie\Specie;
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
        yii::error(\yii\helpers\VarDumper::dumpAsString($aquariums));
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
            // yii::error(\yii\helpers\VarDumper::dumpAsString($aquariumSpecies));
            foreach ($aquariumSpecies as $key => $aqSpecie) {
                foreach ($species as $key => $specie) {
                    $found = false;
                    $specieNotFound = $specie->nombre;
                    // yii::error(\yii\helpers\VarDumper::dumpAsString('aqSpecie:'.$aqSpecie['nombre'].'  specie:'.$specie->nombre));                    
                    if($aqSpecie['nombre']==$specie->nombre){ //si encuentra la especie, o sea hay una cantidad registrada para ese acuario de esa especie//
                        $data[$aquarium->nombre][$aqSpecie['nombre']] = (int)$aqSpecie['cantidad'];      
                        $found = true;
                        // yii::error(\yii\helpers\VarDumper::dumpAsString($found));
                    }
                    if(!$found){
                        $data[$aquarium->nombre][$specieNotFound] = 0;
                        // yii::error(\yii\helpers\VarDumper::dumpAsString('specieNotFound:'.$specieNotFound));                       
                    }
                }
            }
        }
        yii::error(\yii\helpers\VarDumper::dumpAsString($data));
        return $data;
    }


    // public static function getAllAquariumsData(){
    //     $searchModel  = new AquariumSearch();
    //     $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    //     $aquariums = $dataProvider->getModels();
    //     $data = [];
    //     $species = Specie::find()->select(['nombre'])->all();

    //     foreach ($aquariums as $key => $aquarium) {
    //         $aquariumSpecies = $aquarium->getQuantityBySpecie(); //obtiene las especies que posee el acuario actual//

    //             $data[$aquarium->nombre][$specie['nombre']] = (int)$specie['cantidad'];   
    //         }
    //     }
    //     yii::error(\yii\helpers\VarDumper::dumpAsString($data));
        
    //     return $data;
    // }


    public static function getFormattedData(){
        $originalData = static::getAllAquariumsData();
        yii::error(\yii\helpers\VarDumper::dumpAsString($originalData));
        $categories = [];
        $series = [];
        foreach ($originalData as $aquariumName => $aquariumData) {
            // yii::error(\yii\helpers\VarDumper::dumpAsString($aquariumData));
            $categories[] = $aquariumName;

            foreach ($aquariumData as $specieName => $quantity) {
 
                $found = false;
                // yii::error(\yii\helpers\VarDumper::dumpAsString($series[0]));
                // yii::error(\yii\helpers\VarDumper::dumpAsString(sizeof($series)));
                for ($i = 0; $i < sizeof($series); $i++) {
                        // yii::error(\yii\helpers\VarDumper::dumpAsString($specieName));
                        // yii::error(\yii\helpers\VarDumper::dumpAsString('series specie name: '.$series[$i]['name']));
                    if($specieName == $series[$i]['name']){//si el nombre de la especie es encontrado en el arreglo $series //
                            // yii::error(\yii\helpers\VarDumper::dumpAsString('entra if loop 3'));
                            $found = true;
                        $targetSeries = $series[$i];
                        // unset($series[$i]);
                        //    $series = array_values($series);
                    }                   
                }
                if(!$found){
                    $targetSeries = ['name'=>$specieName, 'data'=>[]];
                    // $targetSeries['data'][]=$quantity;
                    // $series[] = $targetSeries;
                }
                $targetSeries['data'][]= $quantity;
                $series[] = $targetSeries;
                // yii::error(\yii\helpers\VarDumper::dumpAsString($targetSeries));
                // yii::error(\yii\helpers\VarDumper::dumpAsString($targetSeries['data']));
            }         
        }
        // yii::error(\yii\helpers\VarDumper::dumpAsString($categories));
        yii::error(\yii\helpers\VarDumper::dumpAsString($series));
        $series = array_values($series);
        $censusData[] = $categories;
        $censusData[] = $series;
        return $censusData;
    }

}
