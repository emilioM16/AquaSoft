<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "insumos".
 *
 * @property integer $idinsumo
 * @property string $nombre
 * @property string $descripcion
 * @property integer $stock
 * @property integer $activo
 * @property string $tipo_tarea_idtipo_tarea
 *
 * @property TiposTarea $tipoTareaIdtipoTarea
 * @property TareasInsumos[] $tareasInsumos
 * @property Tareas[] $tareaIdtareas
 */
class Supply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'insumos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'stock', 'tipo_tarea_idtipo_tarea'], 'required'],
            [['stock', 'activo'], 'integer'],
            [['nombre', 'tipo_tarea_idtipo_tarea'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 200],
            [['tipo_tarea_idtipo_tarea'], 'exist', 'skipOnError' => true, 'targetClass' => TiposTarea::className(), 'targetAttribute' => ['tipo_tarea_idtipo_tarea' => 'idtipo_tarea']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idinsumo' => 'Idinsumo',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'stock' => 'Stock',
            'activo' => 'Activo',
            'tipo_tarea_idtipo_tarea' => 'Tipo Tarea Idtipo Tarea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoTareaIdtipoTarea()
    {
        return $this->hasOne(TiposTarea::className(), ['idtipo_tarea' => 'tipo_tarea_idtipo_tarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareasInsumos()
    {
        return $this->hasMany(TareasInsumos::className(), ['insumo_idinsumo' => 'idinsumo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareaIdtareas()
    {
        return $this->hasMany(Tareas::className(), ['idtarea' => 'tarea_idtarea'])->viaTable('tareas_insumos', ['insumo_idinsumo' => 'idinsumo']);
    }
}
