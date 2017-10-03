<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipos_tarea".
 *
 * @property string $idtipo_tarea
 */
class TaskTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipos_tarea';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idtipo_tarea'], 'required'],
            [['idtipo_tarea'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtipo_tarea' => 'Idtipo Tarea',
        ];
    }
}
