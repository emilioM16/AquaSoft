<?php

namespace app\models\task;

use Yii;
use app\models\task\TaskSpecimen;
use app\models\specimen\Specimen;
use app\models\task\Task;
use yii\db\Expression;
use yii\base\Exception;
use app\models\aquarium\Aquarium;


/**
 * This is the model class for table "TAREA_EJEMPLAR".
 *
 * @property integer $idTareaEjemplar
 * @property integer $TAREA_idTarea
 * @property integer $EJEMPLAR_especie_idEspecie
 * @property integer $EJEMPLAR_acuario_idAcuario
 * @property integer $cantidad

 * @property Specimen $especie
 * @property Task $tarea
 */
class TaskSpecimen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TAREA_EJEMPLAR';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TAREA_idTarea', 'EJEMPLAR_especie_idEspecie', 'EJEMPLAR_acuario_idAcuario', 'cantidad'], 'required'],
            [['TAREA_idTarea', 'EJEMPLAR_especie_idEspecie', 'EJEMPLAR_acuario_idAcuario', 'cantidad'], 'integer'],
            [['EJEMPLAR_especie_idEspecie', 'EJEMPLAR_acuario_idAcuario'], 'exist', 'skipOnError' => true, 'targetClass' => Specimen::className(), 'targetAttribute' => ['EJEMPLAR_especie_idEspecie' => 'especie_idEspecie', 'EJEMPLAR_acuario_idAcuario' => 'acuario_idAcuario']],
            [['TAREA_idTarea'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['TAREA_idTarea' => 'idTarea']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TAREA_idTarea' => 'Tarea Id Tarea',
            'EJEMPLAR_especie_idEspecie' => 'Especie',
            'EJEMPLAR_acuario_idAcuario' => 'Acuario',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspecie()
    {
        return $this->hasOne(Specimen::className(), ['especie_idEspecie' => 'EJEMPLAR_especie_idEspecie', 'acuario_idAcuario' => 'EJEMPLAR_acuario_idAcuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarea()
    {
        return $this->hasOne(Task::className(), ['idTarea' => 'TAREA_idTarea']);
    }
    

    //Incorporar ejemplares
    public static function addSpecimens($quantities,$specie){
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
                            $task->descripcion = 'Esta tarea fue creada a través de la sección de ejemplares';
                            $task->USUARIO_idUsuario = Yii::$app->user->identity->idUsuario;
                            $task->horaInicio = '00:00';
                            $task->fechaHoraInicio = new Expression('NOW()');
                            $task->fechaHoraFin = new Expression('NOW()');
                            $task->fechaHoraRealizacion = new Expression('NOW()');
                            $task->ACUARIO_idAcuario = $idAquarium;
                            $task->TIPO_TAREA_idTipoTarea = 'Incorporar ejemplares';

                            if($task->save()){ //si se guarda la tarea, adiciona la cantidad introducida y la guarda//

                                $specimen = Specimen::getSpecimen($idAquarium, $specie->idEspecie);
                                
                                if($specimen==null){
                                    $specimen = new Specimen();
                                    $specimen->especie_idEspecie = $specie->idEspecie;
                                    $specimen->acuario_idAcuario = $idAquarium;
                                    $specimen->cantidad = $quantity;
                                }else{
                                    $specimen->cantidad = $quantity + $specimen->cantidad;
                                }

                                if($specimen->save()){ //si se guarda la tarea, actualiza la cantidad disponible del acuario//
                                    
                                    $taskSpecimen = new TaskSpecimen();
                                    $taskSpecimen->TAREA_idTarea = $task->idTarea;
                                    $taskSpecimen->EJEMPLAR_especie_idEspecie = $specie->idEspecie;
                                    $taskSpecimen->EJEMPLAR_acuario_idAcuario = $idAquarium;
                                    $taskSpecimen->cantidad = $quantity;

                                    if($taskSpecimen->save()){
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
                       return Yii::$app->session->setFlash('error', "Ocurrió un error al realizar la operación. 
                                                    Es posible que la disponibilidad de espacio para uno o varios de los acuarios seleccionados haya cambiado. 
                                                    Intente nuevamente. ");                            
                    }
                }else{
                    return Yii::$app->session->setFlash('error', "Ocurrió un error al realizar la operación. 
                    Es posible que la disponibilidad de espacio para uno o varios de los acuarios seleccionados haya cambiado. 
                    Intente nuevamente. ");          
                }
            } //fin del FOR//
            return Yii::$app->session->setFlash('success', "Los ejemplares se incorporaron correctamente a el/los acuario/s seleccionado/s.");
        }catch (Exception $e){
            $transaction->rollback();
            return Yii::$app->session->setFlash('error', $e);
        }
    }


    //Quitar ejemplares//
    public static function removeSpecimens($quantities,$specie){
        try{ 
            foreach ($quantities as $idAquarium => $quantity) { 

                $transaction = Yii::$app->db->beginTransaction();
                
                $aquarium = Aquarium::findOne($idAquarium);

                $totalQuantity = $specie->minEspacio * $quantity; //calcula la cantidad total de espacio necesaria//

                if($aquarium->getQuantity($specie->idEspecie) >= $quantity){ //si hay ejemplares suficientes que remover del acuario, actualiza el espacio disponible y guarda las tareas// 

                    $aquarium->espacioDisponible = $aquarium->espacioDisponible + $totalQuantity; //actualiza el espacio disponible del acuario//

                    if($aquarium->save()){

                        $task = new Task();                 
                        $task->titulo = 'Quitar ejemplares';
                        $task->descripcion = 'Esta tarea fue creada a través de la sección de ejemplares';
                        $task->USUARIO_idUsuario = Yii::$app->user->identity->idUsuario;
                        $task->fechaHoraInicio = new Expression('NOW()');
                        $task->horaInicio = '00:00';
                        $task->fechaHoraFin = new Expression('NOW()');
                        $task->fechaHoraRealizacion = new Expression('NOW()');
                        $task->ACUARIO_idAcuario = $idAquarium;
                        $task->TIPO_TAREA_idTipoTarea = 'Quitar ejemplares';

                        if($task->save()){ //si se guarda la tarea, adiciona la cantidad introducida y la guarda//

                            $taskSpecimen = new TaskSpecimen();
                            $taskSpecimen->TAREA_idTarea = $task->idTarea;
                            $taskSpecimen->EJEMPLAR_especie_idEspecie = $specie->idEspecie;
                            $taskSpecimen->EJEMPLAR_acuario_idAcuario = $idAquarium;
                            $taskSpecimen->cantidad = $quantity * (-1);

                            if($taskSpecimen->save()){ //si se guarda la tarea, actualiza la cantidad disponible del acuario//
                                
                                $specimen = Specimen::getSpecimen($idAquarium, $specie->idEspecie);
                                $specimen->cantidad = $specimen->cantidad - $quantity;
                                
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
                    return Yii::$app->session->setFlash('error', "Ocurrió un error al realizar la operación. 
                                                Es posible que la disponibilidad de espacio para uno o varios de los acuarios seleccionados haya cambiado. 
                                                Intente nuevamente. ");                            
                }
            } //fin del FOR//
            return Yii::$app->session->setFlash('success', "Los ejemplares se quitaron correctamente de los acuarios seleccionados.");
        }catch (Exception $e){
            $transaction->rollback();
            return Yii::$app->session->setFlash('error', $e);
        }
    }




    public static function transferSpecimens($quantities, $specie, $originId){
        try{ 
            foreach ($quantities as $idAquarium => $quantity) { 

                $transaction = Yii::$app->db->beginTransaction();
                
                $originAquarium = Aquarium::findOne($originId);

                $totalQuantity = $specie->minEspacio * $quantity; //calcula la cantidad total de espacio necesaria//

                if($originAquarium->getQuantity($specie->idEspecie) >= $quantity){ //si hay ejemplares suficientes que remover del acuario, actualiza el espacio disponible y guarda las tareas// 

                    $originAquarium->espacioDisponible = $originAquarium->espacioDisponible + $totalQuantity; //actualiza el espacio disponible del acuario//

                    if($originAquarium->save()){ //guarda los datos en el acuario de destino//

                        $task = new Task();                 
                        $task->titulo = 'Transferir ejemplares';
                        $task->descripcion = 'Esta tarea fue creada a través de la sección de ejemplares';
                        $task->USUARIO_idUsuario = Yii::$app->user->identity->idUsuario;
                        $task->fechaHoraInicio = new Expression('NOW()');
                        $task->horaInicio = '00:00';
                        $task->fechaHoraFin = new Expression('NOW()');
                        $task->fechaHoraRealizacion = new Expression('NOW()');
                        $task->ACUARIO_idAcuario = $originId;
                        $task->TIPO_TAREA_idTipoTarea = 'Transferir ejemplares';

                        if($task->save()){ //si se guarda la tarea, adiciona la cantidad introducida y la guarda//

                            $taskSpecimen = new TaskSpecimen();
                            $taskSpecimen->TAREA_idTarea = $task->idTarea;
                            $taskSpecimen->EJEMPLAR_especie_idEspecie = $specie->idEspecie;
                            $taskSpecimen->EJEMPLAR_acuario_idAcuario = $originId;
                            $taskSpecimen->cantidad = $quantity * (-1);

                            if($taskSpecimen->save()){ //si se guarda la tarea, actualiza la cantidad disponible del acuario//
                                
                                $specimen = Specimen::getSpecimen($originId, $specie->idEspecie);
                                $specimen->cantidad = $specimen->cantidad - $quantity;
                                
                                if($specimen->save()){ //si se guardan los registros del remover los ejemplares del acuario de origen, se guardan los registro del acuario de destino//

                                    $destinationAquarium = Aquarium::findOne($idAquarium);

                                    if($specie->validConditions($destinationAquarium)){ //si las condiciones son válidas, calcula la cantidad de espacio requerido para su validación//

                                        if($destinationAquarium->espacioDisponible >= $totalQuantity){ //si hay espacio suficiente en el acuario, actualiza el espacio disponible y guarda las tareas// 

                                            $destinationAquarium->espacioDisponible = $destinationAquarium->espacioDisponible - $totalQuantity; //actualiza el espacio disponible del acuario//

                                            if($destinationAquarium->save()){

                                                $specimen = Specimen::getSpecimen($idAquarium, $specie->idEspecie);
                                                
                                                if($specimen==null){
                                                    $specimen = new Specimen();
                                                    $specimen->especie_idEspecie = $specie->idEspecie;
                                                    $specimen->acuario_idAcuario = $idAquarium;
                                                    $specimen->cantidad = $quantity;
                                                }else{
                                                    $specimen->cantidad = $quantity + $specimen->cantidad;
                                                }

                                                if($specimen->save()){ //si se guarda la tarea, actualiza la cantidad disponible del acuario//
                                                    
                                                    $taskSpecimen = new TaskSpecimen();
                                                    $taskSpecimen->TAREA_idTarea = $task->idTarea;
                                                    $taskSpecimen->EJEMPLAR_especie_idEspecie = $specie->idEspecie;
                                                    $taskSpecimen->EJEMPLAR_acuario_idAcuario = $idAquarium;
                                                    $taskSpecimen->cantidad = $quantity;

                                                    if($taskSpecimen->save()){
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
                                        }else{ //si no hay espacio suficiente muestra un mensaje//
                                            return Yii::$app->session->setFlash('error', "Ocurrió un error al realizar la operación. 
                                                                        Es posible que la disponibilidad de espacio para uno o varios de los acuarios seleccionados haya cambiado. 
                                                                        Intente nuevamente. ");                            
                                        }
                                    }else{
                                        return Yii::$app->session->setFlash('error', "Ocurrió un error al realizar la operación. 
                                        Es posible que la disponibilidad de espacio para uno o varios de los acuarios seleccionados haya cambiado. 
                                        Intente nuevamente. ");          
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
                    }else{
                        throw new Exception('Ocurrió un error al guardar la información.');         
                    }
                }else{ //si no hay espacio suficiente muestra un mensaje//
                    return Yii::$app->session->setFlash('error', "Ocurrió un error al realizar la operación. 
                                                Es posible que la disponibilidad de espacio para uno o varios de los acuarios seleccionados haya cambiado. 
                                                Intente nuevamente. ");                            
                }
            } //fin del FOR//
            return Yii::$app->session->setFlash('success', "Los ejemplares se transfirieron correctamente al acuario seleccionado.");
        }catch (Exception $e){
            $transaction->rollback();
            return Yii::$app->session->setFlash('error', $e);
        }
    }

}