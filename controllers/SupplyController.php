<?php

namespace app\controllers;

use Yii;
use app\models\supply\Supply;
use app\models\supply\SupplySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\helpers\Json;
use app\models\task\TaskType;
use yii\widgets\ActiveForm;
/**
 * SupplyController implements the CRUD actions for Supply model.
 */
class SupplyController extends Controller
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
     * Lists all Supply models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SupplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    private function getTaskTypes(){
        return TaskType::find()
        ->where(['!=','idTipoTarea','Incorporar ejemplares'])
        ->andWhere(['!=','idTipoTarea','Transferir ejemplares'])
        ->andWhere(['!=','idTipoTarea','Quitar ejemplares'])
        ->all(); 
    }

    /**
     * Displays a single Supply model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Supply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Supply();

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['index', 'id' => $model->idInsumo]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'taskTypes'=>$this->getTaskTypes()
            ]);
        }
    }

    /**
     * Updates an existing Supply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['index', 'id' => $model->idInsumo]);
        } else {
            return $this->renderAjax('update', [
                'taskTypes'=>$this->getTaskTypes(),
                'model' =>  $this->findModel($id),
            ]);
        }
    }

    /**
     * Deletes an existing Supply model.
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
     * Finds the Supply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Supply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Supply::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetStock($supplyId)
    {
       $supplyStock = Supply::findOne(['idInsumo'=>$supplyId])->stock;
       Yii::$app->response->format = 'json';
       return $supplyStock;
    }

    public function actionValidation($id){ //utilizado para la validación con ajax, toma los datos ingresados y los manda al modelo User para su validación.
        
        if($id!=-1){ 
            $scenario = 'update';
        }else{
            $scenario = 'create';
        }

        $model = new Supply(['scenario'=>$scenario,'idInsumo'=>$id]);

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }
}
