<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estados_planificacion".
 *
 * @property string $idestado_planificacion
 */
class PlanningStates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estados_planificacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idestado_planificacion'], 'required'],
            [['idestado_planificacion'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idestado_planificacion' => 'Idestado Planificacion',
        ];
    }
}
