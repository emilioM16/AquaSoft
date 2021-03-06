<?php

namespace app\models\aquarium;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\task\Task;
use app\models\aquarium\Aquarium;
use app\models\aquarium\UserAquariums;
use app\models\conditions\EnviromentalConditions;
use app\models\specimen\Specimen;
use app\models\specie\Specie;


/**
 * This is the model class for table "acuarios".
 *
 * @property integer $idAcuario
 * @property string $nombre
 * @property string $descripcion
 * @property integer $capacidadMaxima
 * @property integer $espacioDisponible
 * @property integer $activo
 *
 * @property UserAquariums[] $acuariosUser
 * @property User[] $usuarioIdusuarios
 */
class Aquarium extends \yii\db\ActiveRecord
{

    public $events = [];
    public $maxQuantity = 0;
    public $canBeDeleted = true;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ACUARIO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'capacidadMaxima','activo'], 'required','message'=>'Campo obligatorio.'],
            [['capacidadMaxima', 'espacioDisponible', 'activo'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 200],
            [ ['nombre'], 'unique', 'when' => function ($model, $attribute) {
                return $model->{$attribute} !== static::getAquarium($model->idAcuario)->$attribute; },
                'on' => 'update',
                'message'=>'El nombre ingresado ya existe'], //en caso de ser una modificación de datos
            [['nombre'], 'unique', 'on' => 'create', 'message'=>'El nombre ingresado ya existe'], //en caso de crear un nuevo especialista
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idAcuario' => 'idAcuario',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'capacidadMaxima' => 'Capacidad máxima',
            'espacioDisponible' => 'Espacio disponible',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAquariums()
    {
        return $this->hasMany(UserAquariums::className(), ['acuario_idAcuario' => 'idAcuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id_usuario' => 'usuario_idusuario'])->viaTable('acuarios_usuarios', ['acuario_idAcuario' => 'idAcuario']);
    }


        /**
     * @return \yii\db\ActiveQuery
     */
     public function getEnviromentalConditions()
     {
         return $this->hasMany(EnviromentalConditions::className(), ['acuario_idAcuario' => 'idAcuario']);
     }


         /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecimens()
    {
        return $this->hasMany(Specimen::className(), ['acuario_idAcuario' => 'idAcuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecies()
    {
        return $this->hasMany(Specie::className(), ['idEspecie' => 'especie_idEspecie'])->viaTable('EJEMPLAR', ['acuario_idAcuario' => 'idAcuario']);
    }


        /**
     * @return \yii\db\ActiveQuery
     */
     public function getTasks()
     {
         return $this->hasMany(Task::className(), ['ACUARIO_idAcuario' => 'idAcuario']);
     }


    public function getAquarium($id){
        return static::findOne(['idAcuario'=>$id]);
    }

    public function beforeSave($insert){
         if(($this->scenario=='create')||($this->scenario=='update')){
            $this->espacioDisponible = $this->capacidadMaxima;
        }
        return parent::beforeSave($insert);
    }

    public static function getActiveAquariums(){
        $aquariums = static::find()->where(['activo'=>1])->all();
        $items = ArrayHelper::map($aquariums, 'idAcuario','nombre');
        return $items;
    }

    public function changeActiveState(){//cambia el estado del acuario según corresponda//
        if ($this->activo==0){
            $this->activo = 1;
        }else{
            $this->activo = 0;
        }
        $this->save(false);
    }

    public function loadEvents(){

        $tasks = $this->tasks;

        foreach ($tasks as $task)
        {
            $planState = $task->planificacion['ESTADO_PLANIFICACION_idEstadoPlanificacion'];
            if(($planState =='Aprobada')||($planState == null)){
                $event = new \yii2fullcalendar\models\Event();
                $event->id = $task->idTarea;
                $event->title = '[' . $task->TIPO_TAREA_idTipoTarea . '] Titulo: ' . $task->titulo . ' - Descripción: ' . $task->descripcion;
                $event->start = date('Y-m-d\TH:i\Z',strtotime($task->fechaHoraInicio));
                $event->end = date('Y-m-d\TH:i\Z',strtotime($task->fechaHoraFin));
                $event->textColor='black';
                $event->borderColor = 'black';
                if($task->fechaHoraRealizacion !== null){
                    $event->backgroundColor ='rgb(5.1%, 66.3%, 12.9%)'; 
                }
                
                $condicionDiaAnterior = (strtotime($task->fechaHoraInicio) < strtotime("today")) && (strtotime($task->fechaHoraFin) < strtotime("today"));
                $condicionDiaPosterior = (strtotime($task->fechaHoraInicio) > strtotime("tomorrow")) && (strtotime($task->fechaHoraFin) > strtotime("tomorrow"));
                

                if($task->fechaHoraRealizacion == null){
                    if(Yii::$app->user->can('administrarTareas')){
                        if($condicionDiaAnterior || $condicionDiaPosterior){
                            $event->editable = false;
                        }else{
                            $event->editable = true;                         
                        }
                    }else{
                        $event->editable = false;
                    }
                }else{
                    $event->editable = true; 
                }

                $this->events[] = $event;
            }
        }
        return $this->events;
    }


    public function getActualConditions(){ //obtiene las condiciones ambientales actuales del acuario//
        $conditions = EnviromentalConditions::find()
                        ->asArray()
                        ->select(['temperatura','ph','salinidad','lux','CO2'])
                        ->where(['acuario_idAcuario'=>$this->idAcuario])
                        ->orderBy(['idCondicionAmbiental'=>SORT_DESC])
                        ->one();
        return $conditions;
    }


    public function getQuantityBySpecie(){
        $species = Specie::find()
                    ->asArray()
                    ->select(['idEspecie','nombre','cantidad'])
                    ->joinWith('specimens')
                    ->where(['acuario_idAcuario'=>$this->idAcuario])
                    ->all();
        return $species;
    }


    public function getQuantity($idSpecie){
        $specimen = Specimen::find()
                    ->where(['acuario_idAcuario'=>$this->idAcuario])
                    ->andWhere(['especie_idEspecie'=>$idSpecie])
                    ->one();
        if($specimen!=null){
            return $specimen->cantidad;
        }else{
            return 0;
        }
    }

}
