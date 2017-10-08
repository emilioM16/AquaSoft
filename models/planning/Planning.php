<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PLANIFICACION".
 *
 * @property integer $idPlanificacion
 * @property string $titulo
 * @property string $anioMes
 * @property string $fechaHoraCreacion
 * @property integer $activo
 * @property integer $ACUARIO_USUARIO_acuario_idAcuario
 * @property integer $ACUARIO_USUARIO_usuario_idUsuario
 * @property string $ESTADO_PLANIFICACION_idEstadoPlanificacion
 *
 * @property ACUARIOUSUARIO $aCUARIOUSUARIOAcuarioIdAcuario
 * @property ESTADOPLANIFICACION $eSTADOPLANIFICACIONIdEstadoPlanificacion
 * @property TAREA[] $tAREAs
 * @property VALIDACION[] $vALIDACIONs
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
            [['titulo', 'anioMes', 'ACUARIO_USUARIO_acuario_idAcuario', 'ACUARIO_USUARIO_usuario_idUsuario', 'ESTADO_PLANIFICACION_idEstadoPlanificacion'], 'required'],
            [['anioMes', 'fechaHoraCreacion'], 'safe'],
            [['activo', 'ACUARIO_USUARIO_acuario_idAcuario', 'ACUARIO_USUARIO_usuario_idUsuario'], 'integer'],
            [['titulo', 'ESTADO_PLANIFICACION_idEstadoPlanificacion'], 'string', 'max' => 45],
            [['ACUARIO_USUARIO_acuario_idAcuario', 'ACUARIO_USUARIO_usuario_idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => ACUARIOUSUARIO::className(), 'targetAttribute' => ['ACUARIO_USUARIO_acuario_idAcuario' => 'acuario_idAcuario', 'ACUARIO_USUARIO_usuario_idUsuario' => 'usuario_idUsuario']],
            [['ESTADO_PLANIFICACION_idEstadoPlanificacion'], 'exist', 'skipOnError' => true, 'targetClass' => ESTADOPLANIFICACION::className(), 'targetAttribute' => ['ESTADO_PLANIFICACION_idEstadoPlanificacion' => 'idEstadoPlanificacion']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPlanificacion' => 'Id Planificacion',
            'titulo' => 'Titulo',
            'anioMes' => 'Anio Mes',
            'fechaHoraCreacion' => 'Fecha Hora Creacion',
            'activo' => 'Activo',
            'ACUARIO_USUARIO_acuario_idAcuario' => 'Acuario  Usuario Acuario Id Acuario',
            'ACUARIO_USUARIO_usuario_idUsuario' => 'Acuario  Usuario Usuario Id Usuario',
            'ESTADO_PLANIFICACION_idEstadoPlanificacion' => 'Estado  Planificacion Id Estado Planificacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getACUARIOUSUARIOAcuarioIdAcuario()
    {
        return $this->hasOne(ACUARIOUSUARIO::className(), ['acuario_idAcuario' => 'ACUARIO_USUARIO_acuario_idAcuario', 'usuario_idUsuario' => 'ACUARIO_USUARIO_usuario_idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getESTADOPLANIFICACIONIdEstadoPlanificacion()
    {
        return $this->hasOne(ESTADOPLANIFICACION::className(), ['idEstadoPlanificacion' => 'ESTADO_PLANIFICACION_idEstadoPlanificacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAREAs()
    {
        return $this->hasMany(TAREA::className(), ['PLANIFICACION_idPlanificacion' => 'idPlanificacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVALIDACIONs()
    {
        return $this->hasMany(VALIDACION::className(), ['PLANIFICACION_idPlanificacion' => 'idPlanificacion']);
    }
}
