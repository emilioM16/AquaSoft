<?php

namespace app\planning\models;

use Yii;

/**
 * This is the model class for table "ESTADO_PLANIFICACION".
 *
 * @property string $idEstadoPlanificacion
 *
 * @property PLANIFICACION[] $pLANIFICACIONs
 */
class PlanningState extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ESTADO_PLANIFICACION';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idEstadoPlanificacion'], 'required'],
            [['idEstadoPlanificacion'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idEstadoPlanificacion' => 'Id Estado Planificacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPLANIFICACIONs()
    {
        return $this->hasMany(PLANIFICACION::className(), ['ESTADO_PLANIFICACION_idEstadoPlanificacion' => 'idEstadoPlanificacion']);
    }
}
