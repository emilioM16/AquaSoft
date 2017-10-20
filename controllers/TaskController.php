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

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    private $task;
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
        // $model = $this->task;
        // $view = Yii::$app->request->post('view');
        // $idAcuario = Yii::$app->request->post('ACUARIO_idAcuario');
        // $idPlanificacion = Yii::$app->request->post('PLANIFICACION_idPlanificacion');
        // $fechaInicio = Yii::$app->request->post('fechaHoraInicio');
        // if ($model->load(Yii::$app->request->post()))
            // yii::error(\yii\helpers\VarDumper::dumpAsString(Yii::$app->request->post()));
        // yii::error(\yii\helpers\VarDumper::dumpAsString(
        //         ' - idTarea: ' . $model->idTarea . 
        //         ' - titulo: ' . $model->titulo . 
        //         ' - descripcion: ' . $model->descripcion . 
        //         ' - fechaHoraInicio: ' . $model->ACUARIO_idAcuario . 
        //         ' - fechaHoraFin: ' . $model->fechaHoraFin) . 
        //         ' - fechaHoraRealizacion: ' . $model->fechaHoraRealizacion . 
        //         ' - idPlanificacion: ' . $model->PLANIFICACION_idPlanificacion . 
        //         ' - USUARIO_idUsuario: ' . $model->USUARIO_idUsuario . 
        //         ' - ACUARIO_idAcuario: ' . $model->ACUARIO_idAcuario . 
        //         ' - TIPO_TAREA_idTipoTarea: ' . $model->TIPO_TAREA_idTipoTarea);
        //     else
        // yii::error(\yii\helpers\VarDumper::dumpAsString($idAcuario . ' - ' . $idPlanificacion . ' - ' . $fechaInicio));
        // $mypost = $model->load(Yii::$app->request->post());
        // return $this->redirect([$view, 'id' => $model->idTarea]);
        // $model->load(Yii::$app->request->post());
    //     if ($model->load(Yii::$app->request->post()))
    //         {
    //     yii::error(\yii\helpers\VarDumper::dumpAsString($model));
    //     yii::error(\yii\helpers\VarDumper::dumpAsString(Yii::$app->request->post()));
    //     yii::error(\yii\helpers\VarDumper::dumpAsString(Yii::$app->request->referrer));
    // }
        if (($model->load(Yii::$app->request->post())) && $model->save()) {
            // return $this->redirect(Yii::$app->request->referrer);
            // return $this->renderAjax('//..task/execute',[
            //         'model'=>$model,
            //         'taskTypes'=>$taskTypes
            //     ]);
            Yii::$app->runAction('task/execute', ['idTarea'=>$model->idTarea]);
            // $this->actionExecute($model->idTarea);
        } else {
            if (Yii::$app->request->isAjax){
                return $this->renderAjax('create',[
                    'model'=>$model,
                    'taskTypes'=>$taskTypes
                ]);
            }else{
                // yii::error(\yii\helpers\VarDumper::dumpAsString('hizo load: '. $model->ACUARIO_idAcuario . ' - ' . $model->PLANIFICACION_idPlanificacion . ' - ' . $model->fechaHoraInicio . ' - ' . $view));
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
            $idTarea = Yii::$app->request->post('idTarea');
        // } 
        
        $model = $this->findModel($idTarea);

        yii::error(\yii\helpers\VarDumper::dumpAsString(Yii::$app->request->post()));

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idTarea]);
        } else {
            if (Yii::$app->request->isAjax){
                return $this->renderAjax('execute',[
                    'model'=>$model
                ]);
            }else{
                return $this->render('execute',[
                    'model'=>$model
                ]);
            }
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
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionValidation($id){ //utilizado para la validación con ajax, toma los datos ingresados y los manda al modelo User para su validación. 

        $model = new Task(['idTarea'=>$id]);

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }        
    }

}
