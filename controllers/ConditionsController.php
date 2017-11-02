<?php

namespace app\controllers;

use Yii;
use app\models\task\Task;
use app\models\conditions\EnviromentalConditions;
use yii\widgets\ActiveForm;

class ConditionsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
