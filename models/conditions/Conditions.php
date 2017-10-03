<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "condiciones_ambientales".
 *
 * @property integer $idcondiciones_ambientales
 * @property double $ph
 * @property double $temperatura
 * @property double $salinidad
 * @property double $lux
 * @property double $co2
 * @property integer $acuario_idacuario
 * @property integer $tarea_idtarea
 */
class Conditions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'condiciones_ambientales';
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcondiciones_ambientales' => 'Idcondiciones Ambientales',
            'ph' => 'Ph',
            'temperatura' => 'Temperatura',
            'salinidad' => 'Salinidad',
            'lux' => 'Lux',
            'co2' => 'Co2',
            'acuario_idacuario' => 'Acuario Idacuario',
            'tarea_idtarea' => 'Tarea Idtarea',
        ];
    }
}
