<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipos_tarea".
 *
 * @property string $idtipo_tarea
 *
 * @property Insumos[] $insumos
 * @property Tareas[] $tareas
 */
class TaskTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TIPO_TAREA';
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsumos()
    {
        return $this->hasMany(Insumos::className(), ['tipo_tarea_idtipo_tarea' => 'idtipo_tarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareas()
    {
        return $this->hasMany(Tareas::className(), ['tipo_tarea_idtipo_tarea' => 'idtipo_tarea']);
    }
}
