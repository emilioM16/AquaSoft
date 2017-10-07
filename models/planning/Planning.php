<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "planificaciones".
 *
 * @property integer $idplanificacion
 * @property string $titulo
 * @property string $aniomes
 * @property string $fechahoracreacion
 * @property integer $activo
 * @property string $estado_planificacion_idestado_planificacion
 * @property integer $acuario_usuario_acuario_idacuario
 * @property integer $acuario_usuario_usuario_idusuario
 *
 * @property AcuariosUsuarios $acuarioUsuarioAcuarioIdacuario
 * @property EstadosPlanificacion $estadoPlanificacionIdestadoPlanificacion
 * @property Tareas[] $tareas
 * @property Validaciones[] $validaciones
 */
class Planning extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'PLANIFICACION';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'aniomes', 'estado_planificacion_idestado_planificacion', 'acuario_usuario_acuario_idacuario', 'acuario_usuario_usuario_idusuario'], 'required'],
            [['aniomes', 'fechahoracreacion'], 'safe'],
            [['activo', 'acuario_usuario_acuario_idacuario', 'acuario_usuario_usuario_idusuario'], 'integer'],
            [['titulo', 'estado_planificacion_idestado_planificacion'], 'string', 'max' => 45],
            [['acuario_usuario_acuario_idacuario', 'acuario_usuario_usuario_idusuario'], 'exist', 'skipOnError' => true, 'targetClass' => AcuariosUsuarios::className(), 'targetAttribute' => ['acuario_usuario_acuario_idacuario' => 'acuario_idacuario', 'acuario_usuario_usuario_idusuario' => 'usuario_idusuario']],
            [['estado_planificacion_idestado_planificacion'], 'exist', 'skipOnError' => true, 'targetClass' => EstadosPlanificacion::className(), 'targetAttribute' => ['estado_planificacion_idestado_planificacion' => 'idestado_planificacion']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idplanificacion' => 'Idplanificacion',
            'titulo' => 'Titulo',
            'aniomes' => 'Aniomes',
            'fechahoracreacion' => 'Fechahoracreacion',
            'activo' => 'Activo',
            'estado_planificacion_idestado_planificacion' => 'Estado Planificacion Idestado Planificacion',
            'acuario_usuario_acuario_idacuario' => 'Acuario Usuario Acuario Idacuario',
            'acuario_usuario_usuario_idusuario' => 'Acuario Usuario Usuario Idusuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuarioUsuarioAcuarioIdacuario()
    {
        return $this->hasOne(AcuariosUsuarios::className(), ['acuario_idacuario' => 'acuario_usuario_acuario_idacuario', 'usuario_idusuario' => 'acuario_usuario_usuario_idusuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoPlanificacionIdestadoPlanificacion()
    {
        return $this->hasOne(EstadosPlanificacion::className(), ['idestado_planificacion' => 'estado_planificacion_idestado_planificacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareas()
    {
        return $this->hasMany(Tareas::className(), ['planificacion_idplanificacion' => 'idplanificacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValidaciones()
    {
        return $this->hasMany(Validaciones::className(), ['planificacion_idplanificacion' => 'idplanificacion']);
    }
}
