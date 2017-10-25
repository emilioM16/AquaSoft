<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\specie\Specie;
use app\models\aquarium\Aquarium;
use app\models\census\Census;
use yii\filters\VerbFilter;

class CensusController extends Controller
{

    public function actionIndex()
     {
        $specieCensus = Census::getAllSpeciesQuantities();
        $aquariums = Census::getAvailableAquariums();
        $data =Census::getAllAquariumsData();
        array_unshift($aquariums,['idAcuario'=>0,'nombre'=>'Todos']);
        return $this->render('index',
                            [
                                'aquariums'=>$aquariums,
                            ]);
     }


    public function actionShowCensus($idAquarium){
        if($idAquarium == 0){ //seleccionó todos los acuarios//
            $censusData = Census::getFormattedData(); 
            $specieCensus = Census::getAllSpeciesQuantities();
            return $this->renderAjax('_barChart',[
                                        'data'=>$censusData,
                                        'speciesData' => $specieCensus
                                    ]);           
        }else{
            $aquarium = Aquarium::findOne(['idAcuario'=>$idAquarium]);
            $species = $aquarium->getQuantityBySpecie();
            $speciesPorcentages = Specie::calculatePorcentageBySpecie($species);
            return $this->renderAjax('_pieChart',[
                                        'porcentages'=>$speciesPorcentages,
                                        'species'=>$species
                                    ]);
        }
    }
}