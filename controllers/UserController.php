<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\AuthAssignment;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Exception;
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
        $authModel = new AuthAssignment();
        $transaction = Yii::$app->db->beginTransaction();
        try{
            if($userModel->load(Yii::$app->request->post()) && $userModel->save()){
                $authModel->item_name = 'especialista';
                $authModel->user_id = strval($userModel->id_usuario);
                if($authModel->save()){
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $userModel->id_usuario]);
                }else{
                    throw new Exception('Ocurrió un error al guardar la información.');
                }
            }else{
                throw new Exception('Ocurrió un error al guardar la información.');
            }
        }catch (Exception $e){
            $transaction->rollback();
        }
        return $this->render('create', [
            'model' => $userModel,
        ]);
    }



    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_usuario]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
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
}
