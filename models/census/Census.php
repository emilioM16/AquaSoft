<?php

namespace app\models\census;

use Yii;
use app\models\aquarium\Aquarium;
use app\models\aquarium\AquariumSearch;
class Census
{

    public static function getAvailableAquariums(){ //devuelve todos los acuarios asignados al usuario y que contengan al menos un ejemplar de cualquier especie//
        $searchModel  = new AquariumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $aquariums = $dataProvider->getModels();

        foreach ($aquariums as $key => $aquarium) {
            $aquariumSpecies = $aquarium->getQuantityBySpecieGreaterCero();
            if(empty($aquariumSpecies)){ //si hay especies en ese acuario
                unset($aquariums[$key]);
            }
        }
        $aquariums = array_values($aquariums);
        return $aquariums;
    }




}
