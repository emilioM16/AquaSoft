<?php

namespace app\models\task;

use Yii;
use app\models\supply\Supply;
use app\models\task\Task;

/**
 * This is the model class for table "TIPO_TAREA".
 *
 * @property string $idTipoTarea
 *
 * @property Supply[] $insumos
 * @property Task[] $tareas
 */
class TaskType extends \yii\db\ActiveRecord
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
            [['idTipoTarea'], 'required'],
            [['idTipoTarea'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoTarea' => 'Id Tipo Tarea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsumos()
    {
        return $this->hasMany(Supply::className(), ['TIPO_TAREA_idTipoTarea' => 'idTipoTarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareas()
    {
        return $this->hasMany(Task::className(), ['TIPO_TAREA_idTipoTarea' => 'idTipoTarea']);
    }
}
