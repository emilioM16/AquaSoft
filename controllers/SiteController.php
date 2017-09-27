<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Login;
use app\models\User;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
     public function actionIndex()
     {
       if(Yii::$app->user->isGuest){
         return $this->redirect('login');
       }
         $this->layout = 'main';
         return $this->render('index');
     }


    public function actionLogin(){
        if(!Yii::$app->user->isGuest){
            return $this->goHome();
        }
        $this->layout = 'login';
        $model = new Login();
        if($model->load(Yii::$app->request->post()) && $model->login()){
            $roleData = User::getRole(Yii::$app->user->identity->id_usuario);
            Yii::$app->session->set('user.role',$roleData->roleName);
            $this->layout = 'main';
            return $this->goHome();
        }
        return $this->render('login',[
            'model' => $model,
        ]);
      }


    public function actionLogout(){
        Yii::$app->user->logout();
        $this->goHome();
    }


}
