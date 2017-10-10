<?php

namespace app\models;

use Yii;

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
 * @property TIPOTAREA $tIPOTAREAIdTipoTarea
 * @property INSUMOTAREA[] $iNSUMOTAREAs
 * @property TAREA[] $tAREAIdTareas
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
            [['TIPO_TAREA_idTipoTarea'], 'exist', 'skipOnError' => true, 'targetClass' => TIPOTAREA::className(), 'targetAttribute' => ['TIPO_TAREA_idTipoTarea' => 'idTipoTarea']],
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
        return $this->hasOne(TIPOTAREA::className(), ['idTipoTarea' => 'TIPO_TAREA_idTipoTarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINSUMOTAREAs()
    {
        return $this->hasMany(INSUMOTAREA::className(), ['INSUMO_idInsumo' => 'idInsumo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAREAIdTareas()
    {
        return $this->hasMany(TAREA::className(), ['idTarea' => 'TAREA_idTarea'])->viaTable('INSUMO_TAREA', ['INSUMO_idInsumo' => 'idInsumo']);
    }
}
