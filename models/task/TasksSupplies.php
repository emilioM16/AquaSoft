<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tareas_insumos".
 *
 * @property integer $insumos_idinsumo
 * @property integer $tarea_idtarea
 * @property integer $cantidad
 */
class TasksSupplies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tareas_insumos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insumos_idinsumo', 'tarea_idtarea', 'cantidad'], 'required'],
            [['insumos_idinsumo', 'tarea_idtarea', 'cantidad'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'insumos_idinsumo' => 'Insumos Idinsumo',
            'tarea_idtarea' => 'Tarea Idtarea',
            'cantidad' => 'Cantidad',
        ];
    }
}
