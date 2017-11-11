<?php

namespace app\models\planning;

use app\models\aquarium\Aquarium;
use app\models\user\User;
use app\models\task\Task;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "PLANIFICACION".
 *
 * @property integer $idPlanificacion
 * @property string $titulo
 * @property string $anioMes
 * @property string $fechaHoraCreacion
 * @property integer $activo
 * @property integer $ACUARIO_USUARIO_acuario_idAcuario
 * @property integer $ACUARIO_USUARIO_usuario_idUsuario
 * @property string $ESTADO_PLANIFICACION_idEstadoPlanificacion
 *
 * @property Acuarium $aCUARIOUSUARIOAcuarioIdAcuario
 * @property User $aCUARIOUSUARIOUsuarioIdUsuario
 * @property Task[] $tAREAs
 * @property Validation[] $vALIDACIONs
 */
class Planning extends \yii\db\ActiveRecord
{

  public $events = [];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'PLANIFICACION';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'anioMes', 'ACUARIO_USUARIO_acuario_idAcuario'], 'required','message'=>'Campo obligatorio'],
            [['anioMes'],'validatePlanningRule'],
            [['anioMes', 'fechaHoraCreacion'], 'safe'],
            [['activo', 'ACUARIO_USUARIO_acuario_idAcuario', 'ACUARIO_USUARIO_usuario_idUsuario'], 'integer'],
          //  [['titulo','requiered','message'=> 'Campo requerido', 'ESTADO_PLANIFICACION_idEstadoPlanificacion'], 'string', 'max' => 45],
            [['ACUARIO_USUARIO_acuario_idAcuario'], 'exist', 'skipOnError' => true, 'targetClass' => Aquarium::className(), 'targetAttribute' => ['ACUARIO_USUARIO_acuario_idAcuario' => 'idAcuario']],
            //[['ACUARIO_USUARIO_usuario_idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['ACUARIO_USUARIO_usuario_idUsuario' => 'idUsuario']],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPlanificacion' => 'Id Planificacion',
            'titulo' => 'Título',
            'anioMes' => 'Fecha',
            'fechaHoraCreacion' => 'Fecha creacion',
            'activo' => 'Activo',
            'ACUARIO_USUARIO_acuario_idAcuario' => 'Acuario',
            'ACUARIO_USUARIO_usuario_idUsuario' => 'Acuario  Usuario Usuario Id Usuario',
            'ESTADO_PLANIFICACION_idEstadoPlanificacion' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getACUARIOUSUARIOAcuarioIdAcuario()
    {
        return $this->hasOne(Aquarium::className(), ['idAcuario' => 'ACUARIO_USUARIO_acuario_idAcuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getACUARIOUSUARIOUsuarioIdUsuario()
    {
        return $this->hasOne(User::className(), ['idUsuario' => 'ACUARIO_USUARIO_usuario_idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAREAs()
    {
        return $this->hasMany(Task::className(), ['PLANIFICACION_idPlanificacion' => 'idPlanificacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVALIDACIONs()
    {
        return $this->hasMany(Validation::className(), ['PLANIFICACION_idPlanificacion' => 'idPlanificacion']);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////
    public function validatePlanning($unMes, $idAcua)
    {
       $marca = true;
       $planificaciones = Planning::find()->where(['ACUARIO_USUARIO_acuario_idAcuario' => $idAcua])->all();
      // $fechaActual = date('Y-m-01');
      // yii::error(\yii\helpers\VarDumper::dumpAsString($fechaActual));
        foreach ($planificaciones as $plani) {

                 if (($plani->anioMes == $unMes)) {
                   $marca = false;
                }
                //  yii::error(\yii\helpers\VarDumper::dumpAsString($unMes));
       }
       return $marca;
    }



    public function validatePlanningRule($attribute, $params){


      if (isset($this->anioMes)&& isset($this->ACUARIO_USUARIO_acuario_idAcuario)) {



        $formattedDate = date("Y-m-d",strtotime($this->anioMes));
        $fechaActual = date('Y-m-01');

        if (!$this->validatePlanning($formattedDate,$this->ACUARIO_USUARIO_acuario_idAcuario)){
          //  $this->addError("La planificacion ya existe para este mes y con este acuario");
              $this->addError($attribute, 'Ya existe una planificacion para este acuario y mes');

          }
          if($formattedDate < $fechaActual){
            $this->addError($attribute, 'No se puede realizar planificacion para meses previos');
          }
          else{
            $this->anioMes = $formattedDate;
            //  yii::error(\yii\helpers\VarDumper::dumpAsString("llega"));
          }

      }



    }




    /////////////////////////////////////////////////////////////////////////////////////////////
    public function unauthorizedPlanning(){
      //devuelve las planificaciones que no fueron autorizadas

      $planificaciones = Planning::find()->where(['ESTADO_PLANIFICACION_idEstadoPlanificacion'=>'SinVerificar'])->all();
       $items = ArrayHelper::map($planificaciones, 'idPlanificacion','titulo');
       return $items;

    }



    /////////////////////////////////////////////////////////////////////////////////////////////
    public function authorizePlanning(){ //
        //el encargado cambia el estado de un Planificacion
        // inserta datos en un campo de descripcion
        //recibe un boolean depende del boton que apreto
        //si [autorizo] cambia estado a Autorizada
        //si [rechazo] cambia el estado a REchazada
        //solicita un motivo
          $this->changeStatus('Autorizada');
          yii::error(\yii\helpers\VarDumper::dumpAsString('entro al autorizar'));
          $this->update();
    }

    //activo es bajo de baja
    /////////////////////////////////////////////////////////////////////////////////////////////
    public function changeStatus($oneState){ //FUNCIONA
      //SinVerificar//Aprobado//Rechazado
        $this->ESTADO_PLANIFICACION_idEstadoPlanificacion = $oneState;
        return $this;
    }
    public function giveLow(){

        $this->activo = 0;
        $this->save(false);
    }


    public function beforeSave($insert){ //FUNCIONA
      if (!isset($this->activo)) {
        $this->activo = 1;
      }
      if (!isset($this->ESTADO_PLANIFICACION_idEstadoPlanificacion)) {
        $this->ESTADO_PLANIFICACION_idEstadoPlanificacion ='SinVerificar';
      }

      $this->ACUARIO_USUARIO_usuario_idUsuario= Yii::$app->user->identity->idUsuario;
    //  $this->validatePlanning('anioMes','ACUARIO_USUARIO_acuario_idAcuario');

      return parent::beforeSave($insert);
    }

    public function loadEvents(){

        $tasks = $this->tAREAs;

        foreach ($tasks as $task)
        {
            $event = new \yii2fullcalendar\models\Event();
            $event->id = $task->idTarea;
            $event->title = $task->titulo;
            $event->start = date('Y-m-d\TH:i\Z',strtotime($task->fechaHoraInicio));
            $event->end = date('Y-m-d\TH:i\Z',strtotime($task->fechaHoraFin));
            // $task->nonstandard = [
            //   'field1' => 'Something I want to be included in object #1',
            //   'field2' => 'Something I want to be included in object #2',
            // ],
            $event->editable = true;
            $this->events[] = $event;
        }
        return $this->events;
    }

}
