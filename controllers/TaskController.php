<?php

namespace app\controllers;

use Yii;
use app\models\task\Task;
use app\models\task\TaskSearch;
use app\models\task\TaskType;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\base\Model; 
use app\models\conditions\EnviromentalConditions;
use app\models\supply\Supply;
use yii\helpers\ArrayHelper;
/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idAcuario, $idPlanificacion = -1, $fechaInicio = '0')
    {
        $model = new Task();
        $model->inicialice($idAcuario, $idPlanificacion, $fechaInicio);

        $taskTypes = TaskType::find()->all();
        if (($model->load(Yii::$app->request->post())) && $model->save()) {
            // return $this->redirect(Yii::$app->request->referrer);
            // return $this->renderAjax('//..task/execute',[
            //         'model'=>$model,
            //         'taskTypes'=>$taskTypes
            //     ]);

            // DESCOMENTAR DE ACÁ EN ADELANTE PARA ENLAZAR LA CREACIÓN DE LA TAREA NO PLANIFICADA CON LA EJECUCIÓN DE LA MISMA **********************************************************************
            // unset($_POST);
            // $_POST['idTarea'] = $model->idTarea;
            // if (!$model->isPlanned()){
            //     // si es no planificada tengo que desplegar la ventana para que la realice
            //     Yii::$app->runAction('task/execute', ['idTarea'=>$model->idTarea]);
            // }else 
                // retorna a la página que la llamó
            // ************************************************************************************************************************************************************
                return $this->redirect(Yii::$app->request->referrer);
        } else {
            if (Yii::$app->request->isAjax){
                return $this->renderAjax('create',[
                    'model'=>$model,
                    'taskTypes'=>$taskTypes
                ]);
            }else{
                return $this->render('create',[
                    'model'=>$model,
                    'taskTypes'=>$taskTypes
                ]);
            }
        }
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($view, $idTarea)
    {
        $model = $this->findModel($idTarea);
        $taskTypes = TaskType::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([$view, 'id' => $model->idTarea]);
        } else {
            if (Yii::$app->request->isAjax){
                return $this->renderAjax('update',[
                    'model'=>$model,
                    'taskTypes'=>$taskTypes
                ]);
            }else{
                return $this->render('update',[
                    'model'=>$model,
                    'taskTypes'=>$taskTypes
                ]);
            }
        }
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Execute an existing Task model.
     * @param integer $id
     * @return mixed
     */
    // public function actionExecute($idTarea = '')
    public function actionExecute()
    {    
        // if (isset($_POST['idTarea']))   
        // {
        // } 
        
        $idTarea = Yii::$app->request->post('idTarea');
        $modelTask = $this->findModel($idTarea);
        if (!$modelTask->wasExecuted())
        {
            yii::error('MODELTASK: '.\yii\helpers\VarDumper::dumpAsString($modelTask));
            yii::error('POST: '.Yii::$app->request->referrer);  
            // obtengo la vista de acuerdo al tipo de tarea
            $this->redirectViewTaskType($modelTask);

            // $modelSupply = new Supply(); // no sé si necesitaré esto
            // if ($vista === 'control')
            // {
            //     // instancio las condiciones ambientales
            //     $modelSend = new EnviromentalConditions();
            // }     
            // if ($modelTask->load(Yii::$app->request->post()) && $modelTask->save()) {
            //     $this->redirect(Yii::$app->request->referrer);
            // } 
            // else {
            //     if (Yii::$app->request->isAjax){
            //         // if ($vista === 'control'){
            //         //    return $this->renderAjax($vista,[
            //         //     'modelTask'=>$modelTask->condicionAmbiental,
            //         //     ]); 
            //         // }
            //         // else
            //         // {
            //         //    return $this->renderAjax($vista,[
            //         //     'modelTask'=>$modelTask->InsumoTareas,
            //         //     ]);  
            //         // }
            //         return $this->renderAjax($vista,[
            //             'model'=> $modelSend,
            //             ]);
                    
            //     }else{
            //         // if ($vista === 'control'){
            //         //    return $this->render($vista,[
            //         //     'modelTask'=>$modelTask->condicionAmbiental,
            //         //     ]); 
            //         // }
            //         // else
            //         // {
            //         //    return $this->render($vista,[
            //         //     'modelTask'=>$modelTask->InsumoTareas,                        
            //         //     ]);  
            //         // }
                    
            //         return $this->render($vista,[
            //             'model'=> $modelSend,
            //         ]);
            //     }
            // }
        }
    }
    

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            $model->ActualizarDuracion(); 
            $model->ActualizarHoraInicio(); 
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionValidation($id){ //utilizado para la validación con ajax, toma los datos ingresados y los manda al modelo Task para su validación. 

        $model = new Task(['idTarea'=>$id]);

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }        
    }

    private function redirectViewTaskType($task){
        $taskType = $task->TIPO_TAREA_idTipoTarea;
        switch ($taskType) {
            case 'Controlar acuario':
                // return 'control';
                return $this->redirect(['../conditions/control', 'idTarea' => $task->idTarea]);     
                break;
            case 'Alimentación':
            case 'Limpieza':
            case 'Reparación':
                // return 'maintenance';
                return $this->redirect(['../taskSupply/addRemoveSupply', 'idTarea' => $task->idTarea]);   
                break;
            case 'Incorporar ejemplares':
                return ''; // ver si se puede reutilizar las pantalla de Melo
                break;
            case 'Transferir ejemplares':
                return ''; // ver si se puede reutilizar las pantalla de Melo
                break;
            default:
                # code...
                break;
        }        
    }


    public function actionControl($idAcuario, $idTarea)
    {
        $task = new Task();

        if($idTarea==-1){ //es no planificada//
            $modelConditions = new EnviromentalConditions();
            $supplyModels = [new Supply()];
            $count = count(Yii::$app->request->post('Supply', []));
            
            if (Model::loadMultiple($supplyModels, Yii::$app->request->post()) && $modelConditions->load(Yii::$app->request->post())) {
                    yii::error(\yii\helpers\VarDumper::dumpAsString($supplyModels));
                    $task->saveControl($modelConditions,$supplyModels);
                    // // foreach ($supplyModels as $key => $supply) {
                    // //     $supply->save();
                    // // }
                    return $this->renderAjax('p',[
                        'supplies'=>$supplyModels
                    ]); 
            }
            else {
                $taskType = new Tasktype(['idTipoTarea'=>'Controlar acuario']);
                $availableSupplies = ArrayHelper::map($taskType->insumos,'idInsumo','nombre');
                $availableSupplies[0] = 'Ninguno';
                ksort($availableSupplies);
                    if (Yii::$app->request->isAjax){
                        return $this->renderAjax('_controlForm',[
                            'conditionsModel'=> $modelConditions,
                            'supplyModels'=>$supplyModels,
                            'availableSupplies'=>$availableSupplies
                            ]);
                        
                    }else{
                        return $this->render('_controlForm',[
                            'conditionsModel'=> $modelConditions,
                            'supplyModels'=>$supplyModels,
                            'availableSupplies'=>$availableSupplies
                        ]);
                    }
                }
        }else{ //la tarea es planificada
            $modelTask = $this->findModel($idTarea);

            if (!$modelTask->wasExecuted())
            {
                // sólo si la tarea no se ha ejecutado Y ES DE LA FECHA, inicializo las condiciones
                $modelConditions = new EnviromentalConditions();
                $modelConditions->inicialice($idTarea, $modelTask->ACUARIO_idAcuario);

                if ($modelConditions->load(Yii::$app->request->post()) && $modelConditions->save()) {
                // yii::error('POST: '.Yii::$app->request->referrer);
                    $this->redirect(Yii::$app->request->referrer);
                } 
                else {
                    if (Yii::$app->request->isAjax){
                        return $this->renderAjax('control',[
                            'conditionsModel'=> $modelConditions,
                            ]);
                        
                    }else{
                        return $this->render('control',[
                            'conditionsModel'=> $modelConditions,
                        ]);
                    }
                }
            }
        }
    }


    public function actionControlValidation($id){ //utilizado para la validación con ajax, toma los datos ingresados y los manda al modelo Task para su validación. 
        
        $model = new EnviromentalConditions(['idCondicionAmbiental'=>$id]);

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            $supplies = Yii::$app->request->post('Supply',[]);
            foreach (array_keys($supplies) as $index) {
                $models[$index] = new Supply();
            }
            Model::loadMultiple($models, Yii::$app->request->post());
            Yii::$app->response->format = 'json';
            return ActiveForm::validateMultiple($models);
        }        
    }


}
