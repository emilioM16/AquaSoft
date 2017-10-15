<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use app\models\specie\Specie;

class SpecimenController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }




    //  public function actionIndex()
    //  {        
    //      $species = Specie::find()->all();
    //      return $this->render('../task/specimensTasks',
    //                     ['species'=>$species]);
    //  }


    //  public function actionCreate(){
    //      return $this->render('create');
    //  }


    //  public function actionView($id){
    //     return $this->render('view',['id'=>$id]);
    //  }
}