<?php

namespace app\controllers;

use Yii;
use app\models\planning\Planning;
use app\models\planning\Validation;
use app\models\planning\RejectedMotive;
use app\models\planning\PlanningSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\response;
use yii\web\Session;

use app\models\aquarium\Aquarium;
use yii\helpers\ArrayHelper;


/**
 * PlanningController implements the CRUD actions for Planning model.
 */
class PlanningController extends Controller
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
     * Lists all Planning models.
     * @return mixed
     */

    public function actionHome(){
      Yii::$app->session->setFlash('success', "La planificacion ha sido guardada con éxito");
      return $this->redirect(['index']);
    }



    public function actionIndex()
    {
        $searchModel = new PlanningSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Planning model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      $model = $this->findModel($id);
      $rol = Yii::$app->user->identity->getRole();
      if($rol == 'especialista'){
        if(($model->activo == 1) && ($model->ACUARIO_USUARIO_usuario_idUsuario == Yii::$app->user->identity->idUsuario)){
            $model->loadEvents();
            $session = Yii::$app->session;
            $session->set('var','view');
    
            return $this->render('view', [
    
                'model' => $model,
            ]);
        }else{
            throw new NotFoundHttpException('No tiene permiso para acceder a la página solicitada'); 
        }
    }else{
        $model->loadEvents();
        $session = Yii::$app->session;
        $session->set('var','view');

        return $this->render('view', [

            'model' => $model,
        ]);
    }


    }

    public function actionCheck($id)
    {
      $model = $this->findModel($id);
      if(($model->activo != 0) && ($model->ESTADO_PLANIFICACION_idEstadoPlanificacion == 'SinVerificar')){
        $model->loadEvents();
        $session = Yii::$app->session;
        $session->set('var','check');

        //cargo el array de sesiones

            return $this->render('check', [
                'model' => $model,
            ]);
      }else{
        throw new NotFoundHttpException('No tiene permiso para acceder a la página solicitada');  
      }
    }


    public function actionDown($id)
    {
        $model = $this->findModel($id);
        if(($model->activo == 1) && ($model->ACUARIO_USUARIO_usuario_idUsuario == Yii::$app->user->identity->idUsuario) && ($model->ESTADO_PLANIFICACION_idEstadoPlanificacion == 'SinVerificar')){
            $model = $model->giveLow();
            Yii::$app->session->setFlash('success', "Planificación eliminada con éxito");
            return $this->redirect(['index']);
        }else{
            throw new NotFoundHttpException('No tiene permiso para acceder a la página solicitada'); 
        }
    }

    public function actionCalendar($idPlan) //FUNCIONA, GUARDA LA PLANIFICION Y VA A LA PANTALLA DE CALENDARIO
    {

      $model = $this->findModel($idPlan);
      $model->loadEvents();

       if ($model->load(Yii::$app->request->post()) && $model->save()) {
                  return $this->redirect([$view]);
        }
            else{
              return $this->render('calendar', [
                  'model' => $model,
              ]);
        }
    }

    /**
     * Creates a new Planning model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */



    public function actionCreate()
    {
        $model = new Planning();
        $aquariums = ArrayHelper::map(Yii::$app->user->identity->getAquariums(),'idAcuario','nombre');

        $session = Yii::$app->session;
        $session->set('var','create');

        if ($model->load(Yii::$app->request->post())&& $model ->save()) {
                return $this->redirect(['calendar',
                'idPlan' => $model->idPlanificacion]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'aquariums'=>$aquariums

                ]);
        }

    }


    /**
     * Updates an existing Planning model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $rol = Yii::$app->user->identity->getRole();
        if($rol == 'especialista'){
            if(($model->activo == 1) && ($model->ACUARIO_USUARIO_usuario_idUsuario == Yii::$app->user->identity->idUsuario) && ($model->ESTADO_PLANIFICACION_idEstadoPlanificacion == 'SinVerificar')){
                $model->loadEvents();
                $session = Yii::$app->session;
                $session->set('var','update');

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->idPlanificacion]);
                } else {
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            }else{
                throw new NotFoundHttpException('No tiene permiso para acceder a la página solicitada');                 
            }
        }else{

        }
    }

    public function actionAutorized($id)
    {
          $modelVal = new Validation();

          $modelVal->PLANIFICACION_idPlanificacion= $id;
          $modelVal->USUARIO_idUsuario= Yii::$app->user->identity->idUsuario;
          $modelVal->save(false);

         $model = $this->findModel($id);
         $model = $model->changeStatus('Aprobada');
         $model->save(false);
         Yii::$app->session->setFlash('success', "Planificación autorizada con éxito");
         return $this->redirect(['index']);

    }

    public function actionRefuse($id)
    {
         $modelValidacion= new Validation();

         $model = $this->findModel($id);
         $motivosRechazo = RejectedMotive::find()->all();

        //llama previamente al before save


         return $this->renderAjax('refuseMotive',[
             'model'=>$model,
             'modelV'=>$modelValidacion,
             'motivos'=>$motivosRechazo,
         ]);
    }

    public function actionMotive($id)
    {
          $modelPlan = $this->findModel($id);
          $modelPlan = $modelPlan->changeStatus('Rechazada');
           $modelPlan->save(false);

          $modelVal= new Validation();
          $modelVal->load(Yii::$app->request->post());


          $modelVal->PLANIFICACION_idPlanificacion= $id;
          $modelVal->USUARIO_idUsuario = Yii::$app->user->identity->idUsuario;

          Yii::$app->session->setFlash('success', "Planificación rechazada con éxito");

        $modelVal->save(false);


            if ($modelVal->load(Yii::$app->request->post())&& $modelVal->save(false)) {
                return $this->redirect(['index']);
            } else {
                    return $this->redirect(['index']);
            }



    }



    /**
     * Finds the Planning model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Planning the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Planning::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
