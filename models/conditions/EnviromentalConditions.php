<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "CONDICION_AMBIENTAL".
 *
 * @property integer $idCondicionAmbiental
 * @property double $ph
 * @property double $temperatura
 * @property double $salinidad
 * @property double $lux
 * @property double $CO2
 * @property integer $acuario_idAcuario
 * @property integer $tarea_idTarea
 *
 * @property ACUARIO $acuarioIdAcuario
 * @property TAREA $tareaIdTarea
 */
class EnviromentalConditions extends \yii\db\ActiveRecord
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
            [['ph', 'temperatura', 'salinidad', 'lux', 'CO2', 'acuario_idAcuario', 'tarea_idTarea'], 'required'],
            [['ph', 'temperatura', 'salinidad', 'lux', 'CO2'], 'number'],
            [['acuario_idAcuario', 'tarea_idTarea'], 'integer'],
            [['acuario_idAcuario'], 'exist', 'skipOnError' => true, 'targetClass' => ACUARIO::className(), 'targetAttribute' => ['acuario_idAcuario' => 'idAcuario']],
            [['tarea_idTarea'], 'exist', 'skipOnError' => true, 'targetClass' => TAREA::className(), 'targetAttribute' => ['tarea_idTarea' => 'idTarea']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCondicionAmbiental' => 'Id Condicion Ambiental',
            'ph' => 'Ph',
            'temperatura' => 'Temperatura',
            'salinidad' => 'Salinidad',
            'lux' => 'Lux',
            'CO2' => 'Co2',
            'acuario_idAcuario' => 'Acuario Id Acuario',
            'tarea_idTarea' => 'Tarea Id Tarea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuarioIdAcuario()
    {
        return $this->hasOne(ACUARIO::className(), ['idAcuario' => 'acuario_idAcuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareaIdTarea()
    {
        return $this->hasOne(TAREA::className(), ['idTarea' => 'tarea_idTarea']);
    }
}
