<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "INSUMO_TAREA".
 *
 * @property integer $INSUMO_idInsumo
 * @property integer $TAREA_idTarea
 * @property integer $cantidad
 *
 * @property INSUMO $iNSUMOIdInsumo
 * @property TAREA $tAREAIdTarea
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
            [['INSUMO_idInsumo'], 'exist', 'skipOnError' => true, 'targetClass' => INSUMO::className(), 'targetAttribute' => ['INSUMO_idInsumo' => 'idInsumo']],
            [['TAREA_idTarea'], 'exist', 'skipOnError' => true, 'targetClass' => TAREA::className(), 'targetAttribute' => ['TAREA_idTarea' => 'idTarea']],
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
    public function getINSUMOIdInsumo()
    {
        return $this->hasOne(INSUMO::className(), ['idInsumo' => 'INSUMO_idInsumo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAREAIdTarea()
    {
        return $this->hasOne(TAREA::className(), ['idTarea' => 'TAREA_idTarea']);
    }
}
