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
// use app\models\user\User;

class CensusController extends Controller
{

    public function actionIndex()
     {
         $aquariums = Census::getAvailableAquariums();
        //  $aquariumSpecies = $aquarium->getQuantityBySpecieGreaterCero();
        //  yii::error(\yii\helpers\VarDumper::dumpAsString($aquariumSpecies));
        // $species = Specie::find()->all();
        array_unshift($aquariums,['idAcuario'=>0,'nombre'=>'Todos']);
        return $this->render('index',
                            [
                                'aquariums'=>$aquariums
                            ]);
     }

     public function actionGetAquariums(){
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $specieId = $parents[0];
                if($specieId == 0){  //seleccionó todas las especies//

                }else{ //seleccionó una especie en particular // 
                    $specie = Specie::findOne($specieId);
                    $aquariums= ArrayHelper::map($specie->getAvailableAquariums(),'idAcuario','nombre');
                    foreach ($aquariums as $id => $nombre) {
                        $out[] = ['id'=>$id, 'name'=>$nombre];
                    }
                }
                return Json::encode(['output'=>$out, 'selected'=>'']);
            }
        }
        return Json::encode(['output'=>'', 'selected'=>'']);
     }
}