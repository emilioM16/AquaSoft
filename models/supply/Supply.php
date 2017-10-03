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
 * @property string $tipos_tarea_idtipo_tarea
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
            [['nombre', 'stock', 'tipos_tarea_idtipo_tarea'], 'required'],
            [['stock', 'activo'], 'integer'],
            [['nombre', 'tipos_tarea_idtipo_tarea'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 200],
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
            'tipos_tarea_idtipo_tarea' => 'Tipos Tarea Idtipo Tarea',
        ];
    }
}
