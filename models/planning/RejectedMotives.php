<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "motivos_rechazo".
 *
 * @property string $idmotivo_rechazo
 */
class RejectedMotives extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'motivos_rechazo';
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
}
