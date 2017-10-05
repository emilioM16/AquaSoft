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
         return $this->render('view', [
             'model' => $this->findModel($id),
         ]);
     }


    public function actionCreate()
    {
        $userModel = new User();
        if($userModel->saveUser()){
            return $this->redirect(['view', 'id' => $userModel->id_usuario]);      
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
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
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
     * Deletes an existing User model.
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

    public function actionValidation(){
        
        $model = new User();

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }        
    }
}
