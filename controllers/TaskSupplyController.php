<?php

namespace app\controllers;

class TaskSupplyController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAddRemoveSupply()
    {
        return $this->render('_supply');
    }

}
