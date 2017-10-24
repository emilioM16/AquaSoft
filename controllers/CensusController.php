<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\specie\Specie;
use app\models\aquarium\Aquarium;
use app\models\census\Census;
// use yii\web\Response;
use yii\filters\VerbFilter;

class CensusController extends Controller
{

    public function actionIndex()
     {
         $aquariums = Census::getAvailableAquariums();
         $aquarium = Aquarium::findOne(2);
         $aquariumSpecies = $aquarium->getQuantityBySpecieGreaterCero();
         $data = Census::getFormattedData();
        //  yii::error(\yii\helpers\VarDumper::dumpAsString($aquariumSpecies));
        //  yii::error(\yii\helpers\VarDumper::dumpAsString(Census::getFormattedData()));
        // $species = Specie::find()->all();
        array_unshift($aquariums,['idAcuario'=>0,'nombre'=>'Todos']);
        return $this->render('index',
                            [
                                'aquariums'=>$aquariums,
                                'data'=>$data,
                            ]);
     }


    public function actionGetCensusData($idAquarium){
        if($idAquarium == 0){ //seleccionó todos los acuarios//
            // $censusData = Census::getFormattedData();            
        }
    }
}