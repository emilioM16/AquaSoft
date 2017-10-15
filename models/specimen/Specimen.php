<?php

namespace app\models\specimen;

use Yii;
use app\models\aquarium\Aquarium;
use app\models\specie\Specie;
use app\models\task\Task;
use app\models\task\TaskSpecimen;
/**
 * This is the model class for table "EJEMPLAR".
 *
 * @property integer $especie_idEspecie
 * @property integer $acuario_idAcuario
 * @property integer $cantidad
 *
 * @property Aquarium $acuarioIdAcuario
 * @property Specie $especieIdEspecie
 * @property TaskSpecimen[] $tAREAEJEMPLARs
 * @property Task[] $tAREAIdTareas
 */
class Specimen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'EJEMPLAR';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['especie_idEspecie', 'acuario_idAcuario', 'cantidad'], 'required'],
            [['especie_idEspecie', 'acuario_idAcuario', 'cantidad'], 'integer'],
            [['acuario_idAcuario'], 'exist', 'skipOnError' => true, 'targetClass' => Aquarium::className(), 'targetAttribute' => ['acuario_idAcuario' => 'idAcuario']],
            [['especie_idEspecie'], 'exist', 'skipOnError' => true, 'targetClass' => Specie::className(), 'targetAttribute' => ['especie_idEspecie' => 'idEspecie']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'especie_idEspecie' => 'Especie Id Especie',
            'acuario_idAcuario' => 'Acuario Id Acuario',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuarioIdAcuario()
    {
        return $this->hasOne(Aquarium::className(), ['idAcuario' => 'acuario_idAcuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspecieIdEspecie()
    {
        return $this->hasOne(Specie::className(), ['idEspecie' => 'especie_idEspecie']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAREAEJEMPLARs()
    {
        return $this->hasMany(TaskSpecimen::className(), ['EJEMPLAR_especie_idEspecie' => 'especie_idEspecie', 'EJEMPLAR_acuario_idAcuario' => 'acuario_idAcuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAREAIdTareas()
    {
        return $this->hasMany(Task::className(), ['idTarea' => 'TAREA_idTarea'])->viaTable('TAREA_EJEMPLAR', ['EJEMPLAR_especie_idEspecie' => 'especie_idEspecie', 'EJEMPLAR_acuario_idAcuario' => 'acuario_idAcuario']);
    }
}
