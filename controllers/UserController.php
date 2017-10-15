<?php

namespace app\controllers;

use Yii;
use app\models\user\User;
use app\models\AuthAssignment;
use app\models\user\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Exception;
use app\models\aquarium\Aquarium;
use yii\widgets\ActiveForm;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $model = $this->findModel(17);
        // $model->activo =1;
        // yii::error(\yii\helpers\VarDumper::dumpAsString($model->save(false)));
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Usuario model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->loadAssignedAquariums();

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


    public function actionCreate()
    {
        $userModel = new User();
        $userModel->scenario = 'create';
        if($userModel->saveUser()){
            $userModel->saveAssignedAquariums();
            return $this->redirect(['index', 'id' => $userModel->idUsuario]);      
        }else{
            $items = Aquarium::getActiveAquariums();
            return $this->renderAjax('create', [
                'model' => $userModel,
                'items'=>$items
            ]);
        }

    }



    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->saveAssignedAquariums();
            return $this->redirect(['index', 'id' => $model->idUsuario]);
        } else {
            if (Yii::$app->request->isAjax){
                $model->loadAssignedAquariums();
                return $this->renderAjax('update',[
                    'model'=>$model,
                ]);
            }else{
                $model->loadAssignedAquariums();
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionChangeState($id)
    {
        $model = $this->findModel($id);
        $model->changeActiveState();
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
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
        $model = new User(['scenario'=>$scenario,'idUsuario'=>$id]);

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }        
    }
}
