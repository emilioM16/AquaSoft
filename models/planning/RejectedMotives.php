<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "motivos_rechazo".
 *
 * @property string $idmotivo_rechazo
 *
 * @property Validaciones[] $validaciones
 */
class RejectedMotives extends \yii\db\ActiveRecord
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
            [['idmotivo_rechazo'], 'required'],
            [['idmotivo_rechazo'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmotivo_rechazo' => 'Idmotivo Rechazo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValidaciones()
    {
        return $this->hasMany(Validaciones::className(), ['motivo_rechazo_idmotivo_rechazo' => 'idmotivo_rechazo']);
    }
}
