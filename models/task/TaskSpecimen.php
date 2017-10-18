<?php

namespace app\models\task;

use Yii;
use app\models\specimen\Specimen;
use app\models\task\Task;




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


    public function addSpecimens($quantity){

    }

    public static function getLastQuantity($idAquarium,$idSpecie){ //obtiene, si existe, la última cantidad de ejemplares que hay en un acuario de una especie determinada//
        $lastTask =  TaskSpecimen::find()
                    ->where(['EJEMPLAR_especie_idEspecie'=>$idSpecie])
                    ->andWhere(['EJEMPLAR_acuario_idAcuario'=>$idAquarium])
                    ->orderBy(['idTareaEjemplar'=>SORT_DESC])
                    ->one();
        if($lastTask!=null){
            return $lastTask->cantidad;
        }else{
            return null;
        }
    }

}