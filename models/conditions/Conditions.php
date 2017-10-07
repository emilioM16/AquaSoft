<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "condiciones_ambientales".
 *
 * @property integer $idcondicion_ambiental
 * @property double $ph
 * @property double $temperatura
 * @property double $salinidad
 * @property double $lux
 * @property double $co2
 * @property integer $acuario_idacuario
 * @property integer $tarea_idtarea
 *
 * @property Acuarios $acuarioIdacuario
 * @property Tareas $tareaIdtarea
 */
class Conditions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'CONDICION_AMBIENTAL';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ph', 'temperatura', 'salinidad', 'lux', 'co2', 'acuario_idacuario', 'tarea_idtarea'], 'required'],
            [['ph', 'temperatura', 'salinidad', 'lux', 'co2'], 'number'],
            [['acuario_idacuario', 'tarea_idtarea'], 'integer'],
            [['acuario_idacuario'], 'exist', 'skipOnError' => true, 'targetClass' => Acuarios::className(), 'targetAttribute' => ['acuario_idacuario' => 'idacuario']],
            [['tarea_idtarea'], 'exist', 'skipOnError' => true, 'targetClass' => Tareas::className(), 'targetAttribute' => ['tarea_idtarea' => 'idtarea']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcondicion_ambiental' => 'Idcondicion Ambiental',
            'ph' => 'Ph',
            'temperatura' => 'Temperatura',
            'salinidad' => 'Salinidad',
            'lux' => 'Lux',
            'co2' => 'Co2',
            'acuario_idacuario' => 'Acuario Idacuario',
            'tarea_idtarea' => 'Tarea Idtarea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuarioIdacuario()
    {
        return $this->hasOne(Acuarios::className(), ['idacuario' => 'acuario_idacuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareaIdtarea()
    {
        return $this->hasOne(Tareas::className(), ['idtarea' => 'tarea_idtarea']);
    }
}
