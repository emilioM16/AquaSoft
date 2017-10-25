<?php

namespace app\controllers;

use Yii;
use app\models\task\Task;
use app\models\conditions\EnviromentalConditions;

class ConditionsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionControl($idTarea)
    {
		// $idTarea = Yii::$app->request->post('idTarea');
    	$modelTask = $this->findModelTask($idTarea);

    	if (!$modelTask->wasExecuted())
        {
        	// sólo si la tarea no se ha ejecutado Y ES DE LA FECHA, inicializo las condiciones
	    	$modelConditions = new EnviromentalConditions();
	    	$modelConditions->inicialice($idTarea, $modelTask->ACUARIO_idAcuario);

        	if ($modelConditions->load(Yii::$app->request->post()) && $modelConditions->save()) {
            yii::error('POST: '.Yii::$app->request->referrer);
                $this->redirect(Yii::$app->request->referrer);
            } 
            else {
                if (Yii::$app->request->isAjax){
                    return $this->renderAjax('control',[
                        'model'=> $modelConditions,
                        ]);
                    
                }else{
                    return $this->render('control',[
                        'model'=> $modelConditions,
                    ]);
                }
            }
    	}
    }

    protected function findModelTask($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            $model->ActualizarDuracion(); 
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
