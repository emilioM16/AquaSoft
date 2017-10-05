<?php

namespace app\controllers;

use Yii;
use app\models\aquarium\Aquarium;
use app\models\aquarium\AquariumSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;

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
    public function actionView($idacuario)
    {
        $model = $this->findModel($idacuario);

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->idacuario]);
        } else {
            if (Yii::$app->request->isAjax){
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
    public function actionUpdate($idacuario)
    {
        $model = $this->findModel($idacuario);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->idacuario]);
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
        $idacuario = Yii::$app->request->post('idacuario');

        $model = $this->findModel($idacuario);
        $model->activo = 0;
        $model->save();
        // $this->findModel($idacuario)->delete();

        return $this->redirect(['index']);
    }

    public function actionDetail($idacuario)
    {
        // $idacuario = Yii::$app->request->post('idacuario');
        // $usuarios_nombre_usuario = Yii::$app->request->post('usuarios_nombre_usuario');
        // $idCondiciones = Yii::$app->request->post('idCondiciones');

        $model = $this->findModel($idacuario);

        return $this->render('detail', [
            'acuario'=>$model,
            ]);
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

        $model = new Aquarium(['scenario'=>$scenario,'idacuario'=>$id]);

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }        
    }
}
