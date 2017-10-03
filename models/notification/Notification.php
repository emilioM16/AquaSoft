<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notificaciones".
 *
 * @property integer $idnotificacion
 * @property string $fechahora
 * @property integer $tareas_idtarea
 * @property string $origen_notificacion
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notificaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fechahora'], 'safe'],
            [['tareas_idtarea', 'origen_notificacion'], 'required'],
            [['tareas_idtarea'], 'integer'],
            [['origen_notificacion'], 'string', 'max' => 45],
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
            'tareas_idtarea' => 'Tareas Idtarea',
            'origen_notificacion' => 'Origen Notificacion',
        ];
    }
}
