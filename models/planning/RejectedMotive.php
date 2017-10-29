<?php

namespace app\models\planning;

use Yii;

/**
 * This is the model class for table "MOTIVO_RECHAZO".
 *
 * @property string $idMotivoRechazo
 *
 * @property VALIDACION[] $vALIDACIONs
 */
class RejectedMotive extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'MOTIVO_RECHAZO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idMotivoRechazo'], 'required'],
            [['idMotivoRechazo'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idMotivoRechazo' => 'Id Motivo Rechazo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVALIDACIONs()
    {
        return $this->hasMany(VALIDACION::className(), ['MOTIVO_RECHAZO_idMotivoRechazo' => 'idMotivoRechazo']);
    }
}
