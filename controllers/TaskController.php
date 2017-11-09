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
    public function actionView($idTarea)
    {
        return $this->render('view', [
            'model' => $this->findModel($idTarea),
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
        //  yii::error(\yii\helpers\VarDumper::dumpAsString($_POST));
        $filtrarTareaAlimentacion = false;
        $acuario = $model->acuario;
        if($acuario != null){
            $conditions = $acuario->actualConditions;
            // si no tiene condiciones ambientales le quito la tarea elimnetación
            $filtrarTareaAlimentacion = ($conditions != null);       
        } 

        if ($filtrarTareaAlimentacion){
                $taskTypes = TaskType::find()
                    ->where(['!=','idTipoTarea','Incorporar ejemplares'])
                    ->andWhere(['!=','idTipoTarea','Transferir ejemplares'])
                    ->andWhere(['!=','idTipoTarea','Quitar ejemplares'])
                    ->andWhere(['!=','idTipoTarea','Alimentación'])
                    ->all();    
            } else {
                $taskTypes = TaskType::find()
                    ->where(['!=','idTipoTarea','Incorporar ejemplares'])
                    ->andWhere(['!=','idTipoTarea','Transferir ejemplares'])
                    ->andWhere(['!=','idTipoTarea','Quitar ejemplares'])
                    ->all(); 
            } 

        $taskTypes = TaskType::find()
                    ->where(['!=','idTipoTarea','Incorporar ejemplares'])
                    ->andWhere(['!=','idTipoTarea','Transferir ejemplares'])
                    ->andWhere(['!=','idTipoTarea','Quitar ejemplares'])
                    ->all();
        if (($model->load(Yii::$app->request->post())) && $model->save()) {
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
    public function actionUpdate($idTarea)
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


    private function redirectViewTaskType($task,$aquariumId){
        $taskType = $task->TIPO_TAREA_idTipoTarea;
        switch ($taskType) {
            case 'Controlar acuario':
                return $this->actionControl($aquariumId,$task->idTarea); 
                break;
            default:
                return $this->actionCommonTasksRealization($task->idTarea,$taskType);
                break;
        }        
    }


    public function actionExecute($idTarea,$idAcuario)
    {    
        $modelTask = $this->findModel($idTarea);
        if (!$modelTask->wasExecuted())
        {
            // obtengo la vista de acuerdo al tipo de tarea
            return $this->redirectViewTaskType($modelTask,$idAcuario);
        }else{
            return $this->renderAjax('_taskDone');
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
            $model->actualizarDuracion();
            $model->actualizarHoraInicio();
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionValidation($id, $idAqua = 0, $idPlan = -1, $fechaInicio = 0){ //utilizado para la validación con ajax, toma los datos ingresados y los manda al modelo User para su validación.

        $model = new Task(['idTarea'=>$id]);
        $model->inicialice($idAqua, $idPlan, $fechaInicio);

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }



    public function actionControl($idAcuario, $idTarea)
    {
        $task = new Task();

        // if($idTarea==-1){ //es no planificada//
            $modelConditions = new EnviromentalConditions();
     
            $count = count(Yii::$app->request->post('Supply', []));
            $supplyModels = [new Supply()];
            for($i = 1; $i < $count; $i++) {
                $supplyModels[] = new Supply();
            }
            if ($modelConditions->load(Yii::$app->request->post())) {
                    if(!Model::loadMultiple($supplyModels, Yii::$app->request->post())){
                        $supplyModels = [];
                    }
                if($idTarea!=-1){
                    $task = $this->findModel($idTarea);
                }else{
                    $task->idTarea = $idTarea;
                }
                $task->saveControl($modelConditions,$supplyModels,$idAcuario);
                return $this->redirect(Yii::$app->request->referrer);
            }
            else {
                $taskType = new Tasktype(['idTipoTarea'=>'Controlar acuario']);
                $availableSupplies = ArrayHelper::map($taskType->insumos,'idInsumo','nombre');
                ksort($availableSupplies);
                    if (Yii::$app->request->isAjax){
                        return $this->renderAjax('_controlForm',[
                            'conditionsModel'=> $modelConditions,
                            'supplyModels'=>$supplyModels,
                            'availableSupplies'=>$availableSupplies,
                            'idAcuario'=>$idAcuario,
                            'idTarea'=>$idTarea
                            ]);
                        
                    }else{
                        return $this->render('_controlForm',[
                            'conditionsModel'=> $modelConditions,
                            'supplyModels'=>$supplyModels,
                            'availableSupplies'=>$availableSupplies
                        ]);
                    }
                }
    }


    public function actionCommonTasksRealization($idTarea,$taskType){

        $task = new Task();
        $count = count(Yii::$app->request->post('Supply', []));
        $supplyModels = [new Supply()];

        for($i = 1; $i < $count; $i++) {
            $supplyModels[] = new Supply();
        }
        if ($task->load(Yii::$app->request->post())) {
                if(!Model::loadMultiple($supplyModels, Yii::$app->request->post())){
                    $supplyModels = [];
                }
            $existentTask = $this->findModel($idTarea);
            $existentTask->observaciones = $task->observaciones;
            $existentTask->saveCommonTask($supplyModels);
            return $this->redirect(Yii::$app->request->referrer);
        }
        else {
            $taskType = new Tasktype(['idTipoTarea'=>$taskType]);
            $availableSupplies = ArrayHelper::map($taskType->insumos,'idInsumo','nombre');
            ksort($availableSupplies);
                if (Yii::$app->request->isAjax){
                    return $this->renderAjax('_commonTasksForm',[
                        'supplyModels'=>$supplyModels,
                        'availableSupplies'=>$availableSupplies,
                        'taskModel'=>$task,
                        'idTarea'=>$idTarea
                        ]);
                    
                }else{
                    return $this->render('_commonTasksForm',[
                        'supplyModels'=>$supplyModels,
                        'availableSupplies'=>$availableSupplies,
                        'taskModel'=>$task,
                        'idTarea'=>$idTarea
                    ]);
                }
            }
    }


    public function actionControlValidation($id){ //utilizado para la validación con ajax, toma los datos ingresados y los manda al modelo Task para su validación. 
        
        $model = new EnviromentalConditions(['idCondicionAmbiental'=>$id]);
        Yii::$app->response->format = 'json';
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            if(Yii::$app->request->post('Supply')!=null){
            $supplies = Yii::$app->request->post('Supply',[]);
            foreach (array_keys($supplies) as $index) {
                $models[$index] = new Supply();
            }
    
            Model::loadMultiple($models, Yii::$app->request->post());

            return ActiveForm::validateMultiple($models);
            }else{
            return ActiveForm::validate($model);
            }
        }        
    }


    public function actionCommonTasksValidation(){ //utilizado para la validación con ajax, toma los datos ingresados y los manda al modelo Task para su validación. 
        
        Yii::$app->response->format = 'json';
        if(Yii::$app->request->isAjax)
        {
            if(Yii::$app->request->post('Supply')!=null){
                $supplies = Yii::$app->request->post('Supply',[]);
                foreach (array_keys($supplies) as $index) {
                    $models[$index] = new Supply();
                }
            
                // if(Model::loadMultiple($models, Yii::$app->request->post())){
                Model::loadMultiple($models, Yii::$app->request->post());

                return ActiveForm::validateMultiple($models);
            }else{
                return true;
            }
            // }else{
            //     return ActiveForm::validate($model);
            // }
        }        
    }


}
