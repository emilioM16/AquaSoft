<?php

namespace app\controllers;

use Yii;
use app\models\task\Task;
use app\models\task\TaskSpecimen;
use app\models\specimen\Specimen;
use app\models\task\TaskSpecimenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\aquarium\Aquarium;
use app\models\specie\Specie;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
/**
 * TaskSpecimenController implements the CRUD actions for TaskSpecimen model.
 */
class TaskSpecimenController extends Controller
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
     * Displays a single TaskSpecimen model.
     * @param integer $TAREA_idTarea
     * @param integer $EJEMPLAR_especie_idEspecie
     * @param integer $EJEMPLAR_acuario_idAcuario
     * @return mixed
     */
    public function actionView($TAREA_idTarea, $EJEMPLAR_especie_idEspecie, $EJEMPLAR_acuario_idAcuario)
    {
        return $this->render('view', [
            'model' => $this->findModel($TAREA_idTarea, $EJEMPLAR_especie_idEspecie, $EJEMPLAR_acuario_idAcuario),
        ]);
    }

    /**
     * Creates a new TaskSpecimen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaskSpecimen();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'TAREA_idTarea' => $model->TAREA_idTarea, 'EJEMPLAR_especie_idEspecie' => $model->EJEMPLAR_especie_idEspecie, 'EJEMPLAR_acuario_idAcuario' => $model->EJEMPLAR_acuario_idAcuario]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaskSpecimen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $TAREA_idTarea
     * @param integer $EJEMPLAR_especie_idEspecie
     * @param integer $EJEMPLAR_acuario_idAcuario
     * @return mixed
     */
    public function actionUpdate($TAREA_idTarea, $EJEMPLAR_especie_idEspecie, $EJEMPLAR_acuario_idAcuario)
    {
        $model = $this->findModel($TAREA_idTarea, $EJEMPLAR_especie_idEspecie, $EJEMPLAR_acuario_idAcuario);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'TAREA_idTarea' => $model->TAREA_idTarea, 'EJEMPLAR_especie_idEspecie' => $model->EJEMPLAR_especie_idEspecie, 'EJEMPLAR_acuario_idAcuario' => $model->EJEMPLAR_acuario_idAcuario]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaskSpecimen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $TAREA_idTarea
     * @param integer $EJEMPLAR_especie_idEspecie
     * @param integer $EJEMPLAR_acuario_idAcuario
     * @return mixed
     */
    public function actionDelete($TAREA_idTarea, $EJEMPLAR_especie_idEspecie, $EJEMPLAR_acuario_idAcuario)
    {
        $this->findModel($TAREA_idTarea, $EJEMPLAR_especie_idEspecie, $EJEMPLAR_acuario_idAcuario)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaskSpecimen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $TAREA_idTarea
     * @param integer $EJEMPLAR_especie_idEspecie
     * @param integer $EJEMPLAR_acuario_idAcuario
     * @return TaskSpecimen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($TAREA_idTarea, $EJEMPLAR_especie_idEspecie, $EJEMPLAR_acuario_idAcuario)
    {
        if (($model = TaskSpecimen::findOne(['TAREA_idTarea' => $TAREA_idTarea, 'EJEMPLAR_especie_idEspecie' => $EJEMPLAR_especie_idEspecie, 'EJEMPLAR_acuario_idAcuario' => $EJEMPLAR_acuario_idAcuario])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddRemove($taskType){ //renderiza la vista de incorporar ejemplares
        $species = Specie::find()->all();
        return $this->renderAjax('_addRemove',
                                [
                                    'species'=>$species,
                                    'taskType'=>$taskType
                                ]);
    }

    public function actionTransfer(){
        $species = Specie::find()->all();
        return $this->renderAjax('_transfer',
                                [
                                    'species'=>$species,
                                ]);
    }
    
    public function actionSpecimensTasks(){
        return $this->render('specimensTasks');
    }


    public function actionGetAquariums($id, $taskType){ //llamado por ajax en la sección de incorporar y remover ejemplares// 
        $selectedSpecie = Specie::findOne($id); //obtiene los datos de la especie seleccionada//
        if($taskType == 'add'){ //en caso que la tarea sea incorporar//
            $compatibleAquariums = $selectedSpecie->getCompatibleAquariums(); //le pide a la especie seleccionada todos los acuarios que sean compatibles con ella//
            return $this->renderAjax('_formInputs',
                                    [
                                        'aquariums'=>$compatibleAquariums,
                                        'taskType'=>'add'
                                    ]);
        }else{ //la tarea es remover//
            $availableAquariums = $selectedSpecie->getAvailableAquariums();
            return $this->renderAjax('_formInputs',
                                    [
                                        'aquariums'=>$availableAquariums,
                                        'taskType'=>'remove'
                                    ]);
        }
    }


    
    public function actionAddSpecimens(){ //se encarga de la incorporación de ejemplares//
        if(isset($_POST['data'])){
            $data = json_decode(Yii::$app->request->post('data'));
            $quantities = json_decode($data->quantities,true);
            $idSpecie = $data->specie;
            $specie = Specie::findOne($idSpecie);
            TaskSpecimen::addSpecimens($quantities,$specie);
            return $this->renderAjax('_alert'); 
        }else{
            return Yii::$app->session->setFlash('error', "Ocurrió un error al realizar la operación. Intente nuevamente.");            
        }
    }
    

    public function actionRemoveSpecimens(){ //se encarga de remover ejemplares//
        if(isset($_POST['data'])){
            $data = json_decode(Yii::$app->request->post('data'));
            $quantities = json_decode($data->quantities,true);
            $idSpecie = $data->specie;
            $specie = Specie::findOne($idSpecie);
            TaskSpecimen::removeSpecimens($quantities,$specie);
            return $this->renderAjax('_alert'); 
        }else{
            return Yii::$app->session->setFlash('error', "Ocurrió un error al realizar la operación. Intente nuevamente.");            
        }
    }


    public function actionGetAvailableAquariums(){
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $specieId = $parents[0];
                $specie = Specie::findOne($specieId);
                $aquariums= ArrayHelper::map($specie->getAvailableAquariums(),'idAcuario','nombre');
                foreach ($aquariums as $id => $nombre) {
                    $out[] = ['id'=>$id, 'name'=>$nombre];
                }
                return Json::encode(['output'=>$out, 'selected'=>'']);
            }
        }
        return Json::encode(['output'=>'', 'selected'=>'']);
    }

}
