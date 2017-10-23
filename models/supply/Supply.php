<?php

namespace app\models\supply;

use Yii;
use app\models\supply\TaskSupply;
use app\models\supply\TaskType;
use app\models\task\Task;

/**
 * This is the model class for table "INSUMO".
 *
 * @property integer $idInsumo
 * @property string $nombre
 * @property string $descripcion
 * @property integer $stock
 * @property integer $activo
 * @property string $TIPO_TAREA_idTipoTarea
 *
 * @property TaskType $tIPOTAREAIdTipoTarea
 * @property TasksSupply[] $iNSUMOTAREAs
 * @property Task[] $tAREAIdTareas
 */
class Supply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'INSUMO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'stock', 'TIPO_TAREA_idTipoTarea'], 'required'],
            [['stock', 'activo'], 'integer'],
            [['nombre', 'TIPO_TAREA_idTipoTarea'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 200],
            [['TIPO_TAREA_idTipoTarea'], 'exist', 'skipOnError' => true, 'targetClass' => TaskType::className(), 'targetAttribute' => ['TIPO_TAREA_idTipoTarea' => 'idTipoTarea']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idInsumo' => 'Id Insumo',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'stock' => 'Stock',
            'activo' => 'Activo',
            'TIPO_TAREA_idTipoTarea' => 'Tipo  Tarea Id Tipo Tarea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTIPOTAREAIdTipoTarea()
    {
        return $this->hasOne(TaskType::className(), ['idTipoTarea' => 'TIPO_TAREA_idTipoTarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINSUMOTAREAs()
    {
        return $this->hasMany(TasksSupply::className(), ['INSUMO_idInsumo' => 'idInsumo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAREAIdTareas()
    {
        return $this->hasMany(Task::className(), ['idTarea' => 'TAREA_idTarea'])->viaTable('INSUMO_TAREA', ['INSUMO_idInsumo' => 'idInsumo']);
    }
}
