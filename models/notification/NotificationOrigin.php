<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ORIGEN_NOTIFICACION".
 *
 * @property string $idOrigenNotificacion
 *
 * @property NOTIFICACION[] $nOTIFICACIONs
 */
class NotificationOrigin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ORIGEN_NOTIFICACION';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idOrigenNotificacion'], 'required'],
            [['idOrigenNotificacion'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idOrigenNotificacion' => 'Id Origen Notificacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOTIFICACIONs()
    {
        return $this->hasMany(NOTIFICACION::className(), ['ORIGEN_NOTIFICACION_idOrigenNotificacion' => 'idOrigenNotificacion']);
    }
}
