<?php

namespace app\models\task;

use Yii;
use app\models\supply;
use app\models\task;

/**
 * This is the model class for table "INSUMO_TAREA".
 *
 * @property integer $INSUMO_idInsumo
 * @property integer $TAREA_idTarea
 * @property integer $cantidad
 *
 * @property Supply $insumo
 * @property Task $tarea
 */
class TasksSupply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'INSUMO_TAREA';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INSUMO_idInsumo', 'TAREA_idTarea'], 'required'],
            [['INSUMO_idInsumo', 'TAREA_idTarea', 'cantidad'], 'integer'],
            [['INSUMO_idInsumo'], 'exist', 'skipOnError' => true, 'targetClass' => Supply::className(), 'targetAttribute' => ['INSUMO_idInsumo' => 'idInsumo']],
            [['TAREA_idTarea'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['TAREA_idTarea' => 'idTarea']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INSUMO_idInsumo' => 'Insumo Id Insumo',
            'TAREA_idTarea' => 'Tarea Id Tarea',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsumo()
    {
        return $this->hasOne(Supply::className(), ['idInsumo' => 'INSUMO_idInsumo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarea()
    {
        return $this->hasOne(Task::className(), ['idTarea' => 'TAREA_idTarea']);
    }
}
