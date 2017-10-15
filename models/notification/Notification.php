<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "NOTIFICACION".
 *
 * @property integer $idNOTIFICACION
 * @property string $fechaHora
 * @property string $ORIGEN_NOTIFICACION_idOrigenNotificacion
 * @property integer $TAREA_idTarea
 *
 * @property ORIGENNOTIFICACION $oRIGENNOTIFICACIONIdOrigenNotificacion
 * @property TAREA $tAREAIdTarea
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'NOTIFICACION';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fechaHora'], 'safe'],
            [['ORIGEN_NOTIFICACION_idOrigenNotificacion', 'TAREA_idTarea'], 'required'],
            [['TAREA_idTarea'], 'integer'],
            [['ORIGEN_NOTIFICACION_idOrigenNotificacion'], 'string', 'max' => 45],
            [['ORIGEN_NOTIFICACION_idOrigenNotificacion'], 'exist', 'skipOnError' => true, 'targetClass' => ORIGENNOTIFICACION::className(), 'targetAttribute' => ['ORIGEN_NOTIFICACION_idOrigenNotificacion' => 'idOrigenNotificacion']],
            [['TAREA_idTarea'], 'exist', 'skipOnError' => true, 'targetClass' => TAREA::className(), 'targetAttribute' => ['TAREA_idTarea' => 'idTarea']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idNOTIFICACION' => 'Id Notificacion',
            'fechaHora' => 'Fecha Hora',
            'ORIGEN_NOTIFICACION_idOrigenNotificacion' => 'Origen  Notificacion Id Origen Notificacion',
            'TAREA_idTarea' => 'Tarea Id Tarea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getORIGENNOTIFICACIONIdOrigenNotificacion()
    {
        return $this->hasOne(ORIGENNOTIFICACION::className(), ['idOrigenNotificacion' => 'ORIGEN_NOTIFICACION_idOrigenNotificacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAREAIdTarea()
    {
        return $this->hasOne(TAREA::className(), ['idTarea' => 'TAREA_idTarea']);
    }
}
