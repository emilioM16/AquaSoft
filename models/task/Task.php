<?php

namespace app\models\task;

use Yii;
use app\models\aquarium\Aquarium;
use app\models\conditions\EnviromentalConditions;
use app\models\notification\Notification;
use app\models\planning\Planning;
// use app\models\specie;
use app\models\specimen\Specimen;
use app\models\supply\Supply;
use app\models\user\User;

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

 * @property EnviromentalConditions[] $condicionesAmbientales
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
    private $isPlanned = true;

    public function inicialice($idAcuario, $idPlanificacion, $fechaInicio)
    {
        $this->ACUARIO_idAcuario = $idAcuario;
        // Si es no planificada seteo con la fecha actual
        $this->PLANIFICACION_idPlanificacion = $idPlanificacion;
        if ($idPlanificacion == -1)
        {
            $this->isPlanned = false;
            $this->fechaHoraInicio = date('Y-m-d H:i:s');
        }
        else
            $this->fechaHoraInicio = date('Y-m-d H:i:s',strtotime($fechaInicio));
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
            [['titulo', 'TIPO_TAREA_idTipoTarea'], 'required'],
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
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'fechaHoraInicio' => 'Fecha Hora Inicio',
            'fechaHoraFin' => 'Fecha Hora Fin',
            'fechaHoraRealizacion' => 'Fecha Hora Realizacion',
            'PLANIFICACION_idPlanificacion' => 'Planificacion Id Planificacion',
            'USUARIO_idUsuario' => 'Usuario Id Usuario',
            'ACUARIO_idAcuario' => 'Acuario Id Acuario',
            'TIPO_TAREA_idTipoTarea' => 'Tipo  Tarea Id Tipo Tarea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondicionesAmbientales()
    {
        return $this->hasMany(EnviromentalConditions::className(), ['tarea_idTarea' => 'idTarea']);
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
        // strtotime Convierte una descripción de fecha/hora textual en una fecha Unix (el número de segundos desde el 1 de Enero del 1970 00:00:00 UTC)
        $this->duracion = strtotime($this->duracion)-strtotime("00:00:00");
        // $this->hora_fin = date("H:i:s",strtotime($this->hora_inicio)+$this->duracion); A esto lo comento porque creo que no manejamos esos atributos (la hora está incluida en los parámetros de fechaHoraInicio y Fin)
        $this->fechaHoraFin = date('Y-m-d H:i:s',strtotime($this->fechaHoraInicio)+$this->duracion);
        return parent::beforeSave($insert);
    }

    public function isPlanned(){
        return $this->isPlanned;
    }
}
