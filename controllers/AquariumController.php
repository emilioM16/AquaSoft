<?php

namespace app\controllers;

use Yii;
use app\models\aquarium\Aquarium;
use app\models\aquarium\AquariumSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use app\models\specie\Specie;
use app\models\user\User;
use yii\helpers\ArrayHelper;

/**
 * AquariumController implements the CRUD actions for Aquarium model.
 */
class AquariumController extends Controller
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
     * Lists all Aquarium models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = User::findOne(Yii::$app->user->identity->idUsuario);
        $searchModel = new AquariumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aquarium model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($idAcuario)
    {
        $model = $this->findModel($idAcuario);

        if (Yii::$app->request->isAjax){
            return $this->renderAjax('view',[
                'model'=>$model,
            ]);
        }else{
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Aquarium model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Aquarium();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->idAcuario]);
        } else {
            if (Yii::$app->request->isAjax){
                $model->activo = 1;
                return $this->renderAjax('create',[
                    'model'=>$model,
                ]);
            }
        }
    }

    /**
     * Updates an existing Aquarium model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($idAcuario)
    {
        $model = $this->findModel($idAcuario);
        $model->setScenario('update');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->idAcuario]);
        } else {
            if (Yii::$app->request->isAjax){
                return $this->renderAjax('update',[
                    'model'=>$model,
                ]);
            }else{
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Deletes an existing Aquarium model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        $idAcuario = Yii::$app->request->post('idAcuario');
        $model = $this->findModel($idAcuario);
        $model->activo = 0;
        $model->save();
        return $this->redirect(['index']);
    }


    public function actionChangeState($id)
    {
        $model = $this->findModel($id);
        $model->changeActiveState();
        return $this->redirect(['index']);
    }


    public function isAssigned($idAcuario){
        $assigned = ArrayHelper::map(Yii::$app->user->identity->getAquariums(),'idAcuario','nombre');
        if(array_key_exists($idAcuario,$assigned)){
            return true;
        }else{
            return false;
        }
    }


    public function actionDetail($idAcuario)
    {   
        if($this->isAssigned($idAcuario)){
            $model = $this->findModel($idAcuario);
            $model->loadEvents(); //carga los eventos del calendario para el acuario seleccionado//
            $actualConditions = $model->getActualConditions();
            $species = $model->getQuantityBySpecie();
            $speciesPorcentages = Specie::calculatePorcentageBySpecie($species);
            return $this->render('detail', [
                'acuario'=>$model,
                'condiciones'=>$actualConditions,
                'especies'=>$species,
                'porcentajes'=>$speciesPorcentages
                ]);
        }else{
            throw new ForbiddenHttpException('No tiene permiso para acceder a este acuario'); 
        }
    }

    /**
     * Finds the Aquarium model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aquarium the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aquarium::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionValidation($id){ //utilizado para la validación con ajax, toma los datos ingresados y los manda al modelo User para su validación.

        if($id!=-1){ //solución horrible, no quedaba otra, mejorar si se puede a futuro
            $scenario = 'update';
        }else{
            $scenario = 'create';
        }

        $model = new Aquarium(['scenario'=>$scenario,'idAcuario'=>$id]);

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }
}
