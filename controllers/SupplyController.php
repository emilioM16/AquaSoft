<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use app\models\supply\Supply;
use yii\helpers\Json;

class SupplyController extends Controller
{

     public function actionGetStock($supplyId)
     {        
        $supplyStock = Supply::findOne(['idInsumo'=>$supplyId])->stock;
        Yii::$app->response->format = 'json';
        return $supplyStock;
     }
}