<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tareas".
 *
 * @property integer $idtarea
 * @property string $titulo
 * @property string $descripcion
 * @property string $fechahorainicio
 * @property string $fechahorafin
 * @property string $fechahorarealizacion
 * @property integer $planificaciones_idplanificacion
 * @property integer $usuarios_idusuario
 * @property string $tipos_tarea_idtipo_tarea
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tareas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'fechahorainicio', 'fechahorafin', 'tipos_tarea_idtipo_tarea'], 'required'],
            [['fechahorainicio', 'fechahorafin', 'fechahorarealizacion'], 'safe'],
            [['planificaciones_idplanificacion', 'usuarios_idusuario'], 'integer'],
            [['titulo', 'tipos_tarea_idtipo_tarea'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtarea' => 'Idtarea',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'fechahorainicio' => 'Fechahorainicio',
            'fechahorafin' => 'Fechahorafin',
            'fechahorarealizacion' => 'Fechahorarealizacion',
            'planificaciones_idplanificacion' => 'Planificaciones Idplanificacion',
            'usuarios_idusuario' => 'Usuarios Idusuario',
            'tipos_tarea_idtipo_tarea' => 'Tipos Tarea Idtipo Tarea',
        ];
    }
}
