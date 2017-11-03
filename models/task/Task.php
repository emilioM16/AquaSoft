<?php

namespace app\models\task;

use Yii;
// use Yii\helpers\VarDumper;
use app\models\aquarium\Aquarium;
use app\models\conditions\EnviromentalConditions;
use app\models\notification\Notification;
use app\models\planning\Planning;
use app\models\specimen\Specimen;
use app\models\supply\Supply;
use app\models\task\TaskSupply;
use app\models\user\User;
use yii\db\Expression;
use yii\base\Exception;
/**
 * This is the model class for table "TAREA".
 *
 * @property integer $idTarea
 * @property string $titulo
 * @property string $descripcion
 * @property string $fechaHoraInicio
 * @property string $fechaHoraFin
 * @property string $fechaHoraRealizacion
 * @property string $observaciones
 * @property integer $PLANIFICACION_idPlanificacion
 * @property integer $USUARIO_idUsuario
 * @property integer $ACUARIO_idAcuario
 * @property string $TIPO_TAREA_idTipoTarea

 * @property EnviromentalConditions $condicionAmbiental
 * @property TaskSupply[] $insumosTarea
 * @property Notification[] $notificaciones
 * @property Aquarium $acuario
 * @property TaskType $tipoTarea
 * @property Planning $planificacion
 * @property User $usuarioRealiza
 * @property TaskSpecimen[] $movimientos

 * @property Supply[] $insumos
 * @property Specimen[] $ejemplares
 */
class Task extends \yii\db\ActiveRecord
{
    public $duracion = 0;
    public $horaInicio;

    public function inicialice($idAcuario, $idPlanificacion, $fechaInicio)
    {
        $this->descripcion=$idAcuario.'--'.$idPlanificacion.'--'.$fechaInicio;
        $this->ACUARIO_idAcuario = $idAcuario;
        if ($idPlanificacion !== -1)
        {
            $this->PLANIFICACION_idPlanificacion = $idPlanificacion;
            $this->fechaHoraInicio = date('Y-m-d H:i:s',strtotime($fechaInicio));
        }

    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TAREA';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'TIPO_TAREA_idTipoTarea','horaInicio', 'duracion'], 'required','message'=>'Campo obligatorio'],
            [['horaInicio'],'validarFechaHoraInicio'],
            [['duracion'],'validarFechaHoraFin'],
            [['fechaHoraInicio', 'fechaHoraFin', 'fechaHoraRealizacion'], 'safe'],
            [['PLANIFICACION_idPlanificacion', 'USUARIO_idUsuario', 'ACUARIO_idAcuario'], 'integer'],
            [['titulo', 'TIPO_TAREA_idTipoTarea'], 'string', 'max' => 45],
            [['descripcion','observaciones'], 'string', 'max' => 200],
            [['ACUARIO_idAcuario'], 'exist', 'skipOnError' => true, 'targetClass' => Aquarium::className(), 'targetAttribute' => ['ACUARIO_idAcuario' => 'idAcuario']],
            [['TIPO_TAREA_idTipoTarea'], 'exist', 'skipOnError' => true, 'targetClass' => TaskType::className(), 'targetAttribute' => ['TIPO_TAREA_idTipoTarea' => 'idTipoTarea']],
            [['PLANIFICACION_idPlanificacion'], 'exist', 'skipOnError' => true, 'targetClass' => Planning::className(), 'targetAttribute' => ['PLANIFICACION_idPlanificacion' => 'idPlanificacion']],
            [['USUARIO_idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['USUARIO_idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTarea' => 'Id Tarea',
            'titulo' => 'Título',
            'descripcion' => 'Descripción',
            'fechaHoraInicio' => 'Fecha Hora Inicio',
            'fechaHoraFin' => 'Fecha Hora Fin',
            'fechaHoraRealizacion' => 'Fecha Hora Realizacion',
            'PLANIFICACION_idPlanificacion' => 'Planificacion Id Planificacion',
            'USUARIO_idUsuario' => 'Usuario Id Usuario',
            'ACUARIO_idAcuario' => 'Acuario Id Acuario',
            'TIPO_TAREA_idTipoTarea' => 'Tipo de tarea',
            'duracion' => 'Duración',
            'horaInicio' => 'Hora de inicio',
            'observaciones'=>'Observaciones'
        ];
    }

    /**
     * valida la hora de inicio
     **/
    public function validarFechaHoraInicio($attribute, $params){
        if ($this->isPlanned()){
            // armo la fecha de inicio en base a la fecha que seleccionó del calendario y hora de inicio que ha ingresado
            $fechaInicioTemp = date_create_from_format("Y-m-d H:i:s",$this->fechaHoraInicio);
            $h = intval(substr($attribute, 0,2));
            $m = intval(substr($attribute, 3,2));
            date_time_set($fechaInicioTemp,$h,$m);
            // valido la superposicion de tareas
            $valida = $this->validarSuperposicionFI($fechaInicioTemp); // LIA *********************************************
            if ($valida){
                $this->fechaHoraInicio = date_format($fechaInicioTemp,"Y-m-d H:i:s");
            } else{
                $this->addError($attribute, 'La hora se superpone con otra tarea');
            }
        }
    }

    /**
     * valida la duración
     **/
    public function validarFechaHoraFin($attribute, $params){
        if ($this->isPlanned()){
            // armo la fecha de fin en base a la fecha que seleccionó del calendario y duración que ha ingresado
            $fechaFinTemp = date_create_from_format("Y-m-d H:i:s",$this->fechaHoraInicio);
            $h = intval(substr($attribute, 0,2));
            $m = intval(substr($attribute, 3,2));
            date_time_set($fechaFinTemp, date_format($fechaFinTemp,"H") + $h, date_format($fechaFinTemp,"i") + $m);
            // valido la superposicion de tareas
            $valida = $this->validarSuperposicionFF($fechaFinTemp); // LIA *********************************************
            if ($valida){
                $this->fechaHoraInicio = date_format($fechaFinTemp,"Y-m-d H:i:s");
            } else{
                $this->addError($attribute, 'La hora se superpone con otra tarea');
            }
        }
     }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondicionAmbiental()
    {
        return $this->hasOne(EnviromentalConditions::className(), ['tarea_idTarea' => 'idTarea']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsumoTareas()
    {
        return $this->hasMany(TaskSupply::className(), ['TAREA_idTarea' => 'idTarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsumos()
    {
        return $this->hasMany(Supply::className(), ['idInsumo' => 'INSUMO_idInsumo'])->viaTable('INSUMO_TAREA', ['TAREA_idTarea' => 'idTarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificaciones()
    {
        return $this->hasMany(Notification::className(), ['TAREA_idTarea' => 'idTarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuario()
    {
        return $this->hasOne(Aquarium::className(), ['idAcuario' => 'ACUARIO_idAcuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoTarea()
    {
        return $this->hasOne(TaskType::className(), ['idTipoTarea' => 'TIPO_TAREA_idTipoTarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanificacion()
    {
        return $this->hasOne(Planning::className(), ['idPlanificacion' => 'PLANIFICACION_idPlanificacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioRealiza()
    {
        return $this->hasOne(User::className(), ['idUsuario' => 'USUARIO_idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientos()
    {
        return $this->hasMany(TaskSpecimen::className(), ['TAREA_idTarea' => 'idTarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEjemplares()
    {
        return $this->hasMany(Specimen::className(), ['especie_idEspecie' => 'EJEMPLAR_especie_idEspecie', 'acuario_idAcuario' => 'EJEMPLAR_acuario_idAcuario'])->viaTable('TAREA_EJEMPLAR', ['TAREA_idTarea' => 'idTarea']);
    }


    public function beforeSave($insert){
        // Primero verifico si se ha ingresado una hora de inicio. Si es así, debo actualizar la fechaHoraInicio con la hora ingresada

        if (!isset($this->fechaHoraInicio))
            $this->fechaHoraInicio = date_format(date_create(),"Y-m-d H:i:s");
        $this->setearHoraInicio();
        // Luego calculo la fecha de fin
        if (!isset($this->fechaHoraFin))

          $this->fechaHoraFin = date_create($this->fechaHoraInicio);
            $this->calcularFechaFin();

            $this->calcularFechaFin();      

        if (!isset($this->fechaHoraInicio)){
            $this->fechaHoraInicio = date_format(date_create(),"Y-m-d H:i:s");
            $this->setearHoraInicio();
        }
        // Luego calculo la fecha de fin
        if (!isset($this->fechaHoraFin)){
            $this->fechaHoraFin = date_create($this->fechaHoraInicio);
            $this->calcularFechaFin();
        }

        $this->USUARIO_idUsuario = Yii::$app->user->identity->idUsuario;
        return parent::beforeSave($insert);
    }

    /// Este método es llamado cuando se traen los datos de la base
    public function actualizarDuracion(){
        // tener en cuenta que la H tiene que estar en mayúsculas para permitirle ingresar entre 1 y 23 horas. Si está en h permite sólo de 1 a 12
        $this->duracion = date('H:i' ,strtotime($this->fechaHoraFin)-strtotime($this->fechaHoraInicio));
    }

    /// Este método es llamado cuando se traen los datos de la base
    public function actualizarHoraInicio(){
        // tener en cuenta que la H tiene que estar en mayúsculas para permitirle ingresar entre 1 y 23 horas. Si está en h permite sólo de 1 a 12
        $this->horaInicio = date('H:i' ,strtotime($this->fechaHoraInicio));
    }

    /// este método setea la fechaHora de inicio en base a la hora de inicio (atributo) ingresada por el usuario
    public function setearHoraInicio(){
      //  $date=date_create();
        if (isset($this->horaInicio)){
            $date= date_create($this->fechaHoraInicio);
            $h = intval(substr($this->horaInicio, 0,2));
            $m = intval(substr($this->horaInicio, 3,2));
            date_time_set($date,$h,$m);
            $this->fechaHoraInicio = date_format($date,"Y-m-d H:i:s");
        }
        else
        $this->fechaHoraInicio = date_format($this->fechaHoraInicio,"Y-m-d H:i:s");
    }

    /// este método calcula la fecha de fin en base a la duración (atributo)
    public function calcularFechaFin(){
      //  $date =date_create($this->fechaHoraInicio);
        if (isset($this->duracion) && $this->duracion !== '00:00'){
            $date =date_create( date_format($this->fechaHoraFin,"Y-m-d H:i:s"));
            $h = intval(substr($this->duracion, 0,2));
            $m = intval(substr($this->duracion, 3,2));
            date_time_set($date,date_format($date,"H") + $h, date_format($date,"i") + $m);
              $this->fechaHoraFin = date_format($date,"Y-m-d H:i:s");
        }
        else
        $this->fechaHoraFin = date_format($this->fechaHoraFin,"Y-m-d H:i:s");
    }

    public function isPlanned(){
        return (isset($this->PLANIFICACION_idPlanificacion));
    }
 

    public function wasExecuted(){
        return (isset($this->fechaHoraRealizacion));
    }


    public function validarSuperposicionFI($fechaHI){
      $tareaSuperpuesta = Task::find()
                      ->asArray()
                      //->select(['idTask'])
                      ->where(['PLANIFICACION_idPlanificacion'=>$this->PLANIFICACION_idPlanificacion])
                    //  ->andWhere(['>',$fechaHI,$this->fechaHoraInicio])
                      //->andWhere(['<',$fechaHI,$this->fechaHoraFin])
                      //->orWhere([$this->fechaHoraInicio=>$fechaHI])
                      //si esto ocurre existe superposicion
                      ->one();
      if ($tareaSuperpuesta !== null) {
        return false;
      }
      else {
        return true;
      }
    }


    //////////////////////////////////////////////////////////////////////////////////////////
    public function validarSuperposicionFF($fechaHoraFin){
      return true;
    }


    private function createAndPopulateTask($idAquarium){
        if($this->idTarea == -1){
            $this->idTarea = null;              
            $this->titulo = 'Control';
            $this->descripcion = 'Esta tarea fue creada a través de la sección de detalle de acuario';
            $this->USUARIO_idUsuario = Yii::$app->user->identity->idUsuario;
            $this->horaInicio = date("H:i:s");
            $this->fechaHoraInicio = null;
            $this->fechaHoraFin = null;
            $this->fechaHoraRealizacion = new Expression('NOW()');
            $this->ACUARIO_idAcuario = $idAquarium;
            $this->TIPO_TAREA_idTipoTarea = 'Controlar acuario';
        }else{
            $this->fechaHoraRealizacion = new Expression('NOW()');   
        } 
    }


    private function checkEnviroment($idAquarium,$conditions,$taskId){ //comprueba las condiciones ambientales ingresadas con las especies que posee//
        $aquarium = Aquarium::findOne(['idAcuario'=>$idAquarium]);
        $aquariumSpecies = $aquarium->species;
        $validConditions = true;
        $i=0;
        while ($validConditions && ($i<sizeof($aquariumSpecies))) {
            $specie = $aquariumSpecies[$i];
            $validConditions = $specie->validConditions($aquarium);
            $i++;
        }
        return $validConditions;
    }
    

    private function removeRepeated($supplies){
        foreach ($supplies as $key => $supply) {
            for ($i=$key+1; $i < sizeof($supplies) ; $i++) { 
                if($supply->idInsumo == $supplies[$i]->idInsumo){
                    $supply->quantity = $supply->quantity + $supplies[$i]->quantity;                                
                    unset($supplies[$i]);
   
                    $supplies[$key] = $supply;
                }
            }
            array_values($supplies);
        }
        return $supplies;
    }


    public function saveControl($conditions, $supplies, $idAquarium){
        try{                
            $transaction = Yii::$app->db->beginTransaction();
            $this->createAndPopulateTask($idAquarium);
            if($this->save()){ //si guarda la tarea se actualiza el stock del insumo//
                if(!empty($supplies)){
                    $supplies = $this->removeRepeated($supplies);
                    foreach ($supplies as $key => $supply) {
                        $updatedSupply = Supply::findOne($supply->idInsumo);
                        $updatedSupply->stock = $updatedSupply->stock - $supply->quantity;

                        if($updatedSupply->save(false)){//si se actualiza el stock del insumo, se crea el registro en la tabla INSUMO_TAREA//
                            $taskSupply = new TasksSupply();
                            $taskSupply->INSUMO_idInsumo = $supply->idInsumo;
                            $taskSupply->TAREA_idTarea = $this->idTarea;
                            $taskSupply->cantidad = $supply->quantity;
                            if($taskSupply->save()){//si guarda el registro en INSUMO_TAREA, se guardan las condiciones ambientales//

                            }else{
                                throw new Exception('Ocurrió un error al guardar la información.');                                                      
                            }
                        }else{
                            throw new Exception('Ocurrió un error al guardar la información.');                                                      
                        }
                    }
                }
                $conditions->acuario_idAcuario = $idAquarium;
                $conditions->tarea_idTarea = $this->idTarea;
                if($conditions->save()){
                    
                    $validConditions = $this->checkEnviroment($idAquarium, $conditions,$this->idTarea);
                    if(!$validConditions){
                        $notification = new Notification();
                        $notification->fechaHora = new Expression('NOW()');
                        $notification->ORIGEN_NOTIFICACION_idOrigenNotificacion = 'Hábitat riesgoso';
                        $notification->TAREA_idTarea = $this->idTarea;
                        if($notification->save()){
                            $transaction->commit();
                        }else{
                            throw new Exception('Ocurrió un error al guardar la información.');                                                      
                        }
                    }else{
                        $transaction->commit();    
                    }
                    return Yii::$app->session->setFlash('success', "El nuevo control se registró correctamente.");              
                }else{
                    throw new Exception('Ocurrió un error al guardar la información.');                                                      
                }
            }else{
                throw new Exception('Ocurrió un error al guardar la información.');                                                      
            }

        }catch(Exception $e){
            $transaction->rollback();
            return Yii::$app->session->setFlash('error', "Ocurrió un error al registrar el control.");            
        }
    }


    public function saveCommonTask($supplies){
        try{                
            $transaction = Yii::$app->db->beginTransaction();
            $this->fechaHoraRealizacion = new Expression('NOW()');
            if($this->save(false)){ //si guarda la tarea se actualiza el stock del insumo//
                if(!empty($supplies)){
                    $supplies = $this->removeRepeated($supplies);
                    foreach ($supplies as $key => $supply) {
                        $updatedSupply = Supply::findOne($supply->idInsumo);
                        $updatedSupply->stock = $updatedSupply->stock - $supply->quantity;

                        if($updatedSupply->save(false)){//si se actualiza el stock del insumo, se crea el registro en la tabla INSUMO_TAREA//
                            $taskSupply = new TasksSupply();
                            $taskSupply->INSUMO_idInsumo = $supply->idInsumo;
                            $taskSupply->TAREA_idTarea = $this->idTarea;
                            $taskSupply->cantidad = $supply->quantity;
                            if($taskSupply->save()){//si guarda el registro en INSUMO_TAREA, se guardan las condiciones ambientales//

                            }else{
                                throw new Exception('Ocurrió un error al guardar la información.');                                                      
                            }
                        }else{
                            throw new Exception('Ocurrió un error al guardar la información.');                                                      
                        }
                    }
                }
                $transaction->commit();
                return Yii::$app->session->setFlash('success', "La nueva tarea se registró correctamente.");                  
            }else{
                throw new Exception('Ocurrió un error al guardar la información.');                                                      
            }
        }catch(Exception $e){
            $transaction->rollback();
            return Yii::$app->session->setFlash('error', "Ocurrió un error al registrar la realización de la tarea.".$e);            
        }
    }

}
