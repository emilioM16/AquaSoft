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
 * @property integer $planificacion_idplanificacion
 * @property integer $usuario_idusuario
 * @property string $tipo_tarea_idtipo_tarea
 *
 * @property CondicionesAmbientales[] $condicionesAmbientales
 * @property Notificaciones[] $notificaciones
 * @property Planificaciones $planificacionIdplanificacion
 * @property TiposTarea $tipoTareaIdtipoTarea
 * @property Usuarios $usuarioIdusuario
 * @property TareasInsumos[] $tareasInsumos
 * @property Insumos[] $insumoIdinsumos
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
            [['titulo', 'fechahorainicio', 'fechahorafin', 'tipo_tarea_idtipo_tarea'], 'required'],
            [['fechahorainicio', 'fechahorafin', 'fechahorarealizacion'], 'safe'],
            [['planificacion_idplanificacion', 'usuario_idusuario'], 'integer'],
            [['titulo', 'tipo_tarea_idtipo_tarea'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 200],
            [['planificacion_idplanificacion'], 'exist', 'skipOnError' => true, 'targetClass' => Planificaciones::className(), 'targetAttribute' => ['planificacion_idplanificacion' => 'idplanificacion']],
            [['tipo_tarea_idtipo_tarea'], 'exist', 'skipOnError' => true, 'targetClass' => TiposTarea::className(), 'targetAttribute' => ['tipo_tarea_idtipo_tarea' => 'idtipo_tarea']],
            [['usuario_idusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_idusuario' => 'id_usuario']],
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
            'planificacion_idplanificacion' => 'Planificacion Idplanificacion',
            'usuario_idusuario' => 'Usuario Idusuario',
            'tipo_tarea_idtipo_tarea' => 'Tipo Tarea Idtipo Tarea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondicionesAmbientales()
    {
        return $this->hasMany(CondicionesAmbientales::className(), ['tarea_idtarea' => 'idtarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificaciones()
    {
        return $this->hasMany(Notificaciones::className(), ['tarea_idtarea' => 'idtarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanificacionIdplanificacion()
    {
        return $this->hasOne(Planificaciones::className(), ['idplanificacion' => 'planificacion_idplanificacion']);
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
    public function getUsuarioIdusuario()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'usuario_idusuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareasInsumos()
    {
        return $this->hasMany(TareasInsumos::className(), ['tarea_idtarea' => 'idtarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsumoIdinsumos()
    {
        return $this->hasMany(Insumos::className(), ['idinsumo' => 'insumo_idinsumo'])->viaTable('tareas_insumos', ['tarea_idtarea' => 'idtarea']);
    }
}
