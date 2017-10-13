<?php

namespace app\controllers;

use Yii;
use app\models\planning\Planning;
use app\models\planning\PlanningSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\response;

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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
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
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idPlanificacion]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idPlanificacion]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Planning model.
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

    public function actionValidarPlanificacion()
    {
      yii::error(\yii\helpers\VarDumper::dumpAsString());
      $model = new Planning();
      $msg = null;

        if ($model ->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = 'json';
            return ActiveForm::render("create");
        }

        if ($model->load(Yii::$app->request->post)) {

            if ($model->validate()) {
              //hacer consulta a bd
            $msg="Planificacion correcta";
            }
            else {
              $model->getErrors();
            }

      }

      return $this->render("create",['model'=> $model, 'msg'=> $msg]);
    }






}
