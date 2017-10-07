<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notificaciones".
 *
 * @property integer $idnotificacion
 * @property string $fechahora
 * @property integer $tarea_idtarea
 * @property string $origen_notificacion_idorigen_notificacion
 *
 * @property OrigenNotificacion $origenNotificacionIdorigenNotificacion
 * @property Tareas $tareaIdtarea
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
            [['fechahora'], 'safe'],
            [['tarea_idtarea', 'origen_notificacion_idorigen_notificacion'], 'required'],
            [['tarea_idtarea'], 'integer'],
            [['origen_notificacion_idorigen_notificacion'], 'string', 'max' => 45],
            [['origen_notificacion_idorigen_notificacion'], 'exist', 'skipOnError' => true, 'targetClass' => OrigenNotificacion::className(), 'targetAttribute' => ['origen_notificacion_idorigen_notificacion' => 'idorigen_notificacion']],
            [['tarea_idtarea'], 'exist', 'skipOnError' => true, 'targetClass' => Tareas::className(), 'targetAttribute' => ['tarea_idtarea' => 'idtarea']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idnotificacion' => 'Idnotificacion',
            'fechahora' => 'Fechahora',
            'tarea_idtarea' => 'Tarea Idtarea',
            'origen_notificacion_idorigen_notificacion' => 'Origen Notificacion Idorigen Notificacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrigenNotificacionIdorigenNotificacion()
    {
        return $this->hasOne(OrigenNotificacion::className(), ['idorigen_notificacion' => 'origen_notificacion_idorigen_notificacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareaIdtarea()
    {
        return $this->hasOne(Tareas::className(), ['idtarea' => 'tarea_idtarea']);
    }
}
