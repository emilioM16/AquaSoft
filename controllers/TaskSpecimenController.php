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
use yii\db\Expression;
use yii\base\Exception;

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
     * Lists all TaskSpecimen models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $searchModel = new TaskSpecimenSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);
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

    public function actionSpecimensTasks(){
        $model = new TaskSpecimen();
        $species = Specie::find()->all();
        return $this->render('specimensTasks',
                    [
                        'species'=>$species,
                        // 'model'=>$model
                    ]);
    }


    public function actionGetAquariums($id){ //llamado por ajax en la sección de incorporar ejemplares// 
        $selectedSpecie = Specie::findOne($id); //obtiene los datos de la especie seleccionada//
        $compatibleAquariums = $selectedSpecie->getCompatibleAquariums(); //le pide a la especie seleccionada todos los acuarios que sean compatibles con ella//
        return $this->renderAjax('_formInputs',
                                ['compatibleAquariums'=>$compatibleAquariums]);
    }


    
    public function actionAddSpecimens(){ //se encarga de la incorporación de ejemplares//
        if(isset($_POST['data'])){
            $data = json_decode(Yii::$app->request->post('data'));
            $quantities = json_decode($data->quantities,true);
            $idSpecie = $data->specie;
            $specie = Specie::findOne($idSpecie);

            try{ 
                foreach ($quantities as $idAquarium => $quantity) { 
                    $transaction = Yii::$app->db->beginTransaction();
                    
                    $aquarium = Aquarium::findOne($idAquarium);

                    if($specie->validConditions($aquarium)){ //si las condiciones son válidas, calcula la cantidad de espacio requerido para su validación//

                        $totalQuantity = $specie->minEspacio * $quantity; //calcula la cantidad total de espacio necesaria//

                        if($aquarium->espacioDisponible >= $totalQuantity){ //si hay espacio suficiente en el acuario, actualiza el espacio disponible y guarda las tareas// 

                            $aquarium->espacioDisponible = $aquarium->espacioDisponible - $totalQuantity; //actualiza el espacio disponible del acuario//

                            if($aquarium->save()){

                                $task = new Task();                 
                                $task->titulo = 'Incorporación de ejemplares';
                                $task->descripcion = 'Esta tarea fue creada a través del menú de ejemplares';
                                $task->USUARIO_idUsuario = Yii::$app->user->identity->idUsuario;
                                $task->fechaHoraInicio = new Expression('NOW()');
                                $task->fechaHoraFin = new Expression('NOW()');
                                $task->fechaHoraRealizacion = new Expression('NOW()');
                                $task->ACUARIO_idAcuario = $idAquarium;
                                $task->TIPO_TAREA_idTipoTarea = 'Incorporar ejemplares';

                                if($task->save()){ //si se guarda la tarea, adiciona la cantidad introducida y la guarda//


                                    $taskSpecimen = new TaskSpecimen();
                                    $taskSpecimen->TAREA_idTarea = $task->idTarea;
                                    $taskSpecimen->EJEMPLAR_especie_idEspecie = $idSpecie;
                                    $taskSpecimen->EJEMPLAR_acuario_idAcuario = $idAquarium;
                                    $taskSpecimen->cantidad = $quantity;

                                    if($taskSpecimen->save()){ //si se guarda la tarea, actualiza la cantidad disponible del acuario//
                                        
                                        $specimen = Specimen::getSpecimen($idAquarium, $idSpecie);

                                        if($specimen==null){
                                            $specimen = new Specimen();
                                            $specimen->especie_idEspecie = $idSpecie;
                                            $specimen->acuario_idAcuario = $idAquarium;
                                            $specimen->cantidad = $quantity;
                                        }else{
                                            $specimen->cantidad = $quantity + $specimen->cantidad;
                                        }
                                        
                                        if($specimen->save()){
                                            $transaction->commit();
                                        }else{
                                            throw new Exception('Ocurrió un error al guardar la información.');          
                                        }
                                    }else{
                                        throw new Exception('Ocurrió un error al guardar la información.');                        
                                    }
                                }else{
                                    throw new Exception('Ocurrió un error al guardar la información.');                        
                                }
                            }else{
                                throw new Exception('Ocurrió un error al guardar la información.');         
                            }
                        }else{ //si no hay espacio suficiente muestra un mensaje//
                            Yii::$app->session->setFlash('error', "No hay espacio suficiente en el acuario".$aquarium->nombre.'.');                            
                        }
                    }else{

                    }
                } //fin del FOR//
                Yii::$app->session->setFlash('success', "Los ejemplares se incorporaron correctamente a el/los acuario/s seleccionado/s.");
                return $this->renderAjax('_alert');
            }catch (Exception $e){
                $transaction->rollback();
                Yii::$app->session->setFlash('error', $e);
            }
            return $this->renderAjax('_alert');
            // return $this->renderAjax('p',['q'=>$actualQuantity]); 
        }else{
            // return $this->renderAjax('p',['q'=>$actualQuantity]); 
        }
    }
    

}
