<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tareas_insumos".
 *
 * @property integer $insumo_idinsumo
 * @property integer $tarea_idtarea
 * @property integer $cantidad
 *
 * @property Insumos $insumoIdinsumo
 * @property Tareas $tareaIdtarea
 */
class TasksSupplies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TAREA_INSUMO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insumo_idinsumo', 'tarea_idtarea', 'cantidad'], 'required'],
            [['insumo_idinsumo', 'tarea_idtarea', 'cantidad'], 'integer'],
            [['insumo_idinsumo'], 'exist', 'skipOnError' => true, 'targetClass' => Insumos::className(), 'targetAttribute' => ['insumo_idinsumo' => 'idinsumo']],
            [['tarea_idtarea'], 'exist', 'skipOnError' => true, 'targetClass' => Tareas::className(), 'targetAttribute' => ['tarea_idtarea' => 'idtarea']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'insumo_idinsumo' => 'Insumo Idinsumo',
            'tarea_idtarea' => 'Tarea Idtarea',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsumoIdinsumo()
    {
        return $this->hasOne(Insumos::className(), ['idinsumo' => 'insumo_idinsumo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareaIdtarea()
    {
        return $this->hasOne(Tareas::className(), ['idtarea' => 'tarea_idtarea']);
    }
}
