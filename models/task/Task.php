<?php

namespace app\models\task;

use Yii;
// use Yii\helpers\VarDumper;
use app\models\aquarium\Aquarium;
use app\models\conditions\EnviromentalConditions;
use app\models\notification\Notification;
use app\models\planning\Planning;
// use app\models\specie;
use app\models\specimen\Specimen;
use app\models\supply\Supply;
use app\models\user\User;
use yii\db\Expression;

/**
 * This is the model class for table "TAREA".
 *
 * @property integer $idTarea
 * @property string $titulo
 * @property string $descripcion
 * @property string $fechaHoraInicio
 * @property string $fechaHoraFin
 * @property string $fechaHoraRealizacion
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
    // private $supplies;
    private $conditions;


    public function inicialice($idAcuario, $idPlanificacion, $fechaInicio)
    {
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
            [['descripcion'], 'string', 'max' => 200],
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
            'horaInicio' => 'Hora de inicio'
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
    public function validarFechaHoraFin(){
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
            $this->setearHoraInicio();
        // Luego calculo la fecha de fin
        if (!isset($this->fechaHoraFin))
            $this->calcularFechaFin();      
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
        $date=date_create();
        if (isset($this->horaInicio)){
            $h = intval(substr($this->horaInicio, 0,2));
            $m = intval(substr($this->horaInicio, 3,2));
            date_time_set($date,$h,$m);
        }
        $this->fechaHoraInicio = date_format($date,"Y-m-d H:i:s");
    }

    /// este método calcula la fecha de fin en base a la duración (atributo)
    public function calcularFechaFin(){  
        $date =date_create($this->fechaHoraInicio);
        if (isset($this->duracion) && $this->duracion !== '00:00'){
            $h = intval(substr($this->duracion, 0,2));
            $m = intval(substr($this->duracion, 3,2));   
            date_time_set($date,date_format($date,"H") + $h, date_format($date,"i") + $m);
        }
        $this->fechaHoraFin = date_format($date,"Y-m-d H:i:s");
    }

    public function isPlanned(){
        return (isset($this->PLANIFICACION_idPlanificacion));
    }


    public function wasExecuted(){
        return (isset($this->fechaHoraRealizacion));
    }

    
    public function saveControl($conditions, $supplies){
        
    }
}