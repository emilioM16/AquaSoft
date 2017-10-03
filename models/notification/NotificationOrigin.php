<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "origen_notificacion".
 *
 * @property string $idorigen_notificacion
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
}
