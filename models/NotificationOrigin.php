<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "origen_notificacion".
 *
 * @property string $idorigen_notificacion
 *
 * @property Notificaciones[] $notificaciones
 */
class NotificationOrigin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'origen_notificacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idorigen_notificacion'], 'required'],
            [['idorigen_notificacion'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idorigen_notificacion' => 'Idorigen Notificacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificaciones()
    {
        return $this->hasMany(Notificaciones::className(), ['origen_notificacion_idorigen_notificacion' => 'idorigen_notificacion']);
    }
}
