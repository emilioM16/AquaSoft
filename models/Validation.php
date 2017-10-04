<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "validaciones".
 *
 * @property integer $idvalidacion
 * @property string $fechahora
 * @property string $observacion
 * @property integer $planificacion_idplanificacion
 * @property integer $usuario_idusuario
 * @property string $motivo_rechazo_idmotivo_rechazo
 *
 * @property MotivosRechazo $motivoRechazoIdmotivoRechazo
 * @property Planificaciones $planificacionIdplanificacion
 * @property Usuarios $usuarioIdusuario
 */
class Validation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'validaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fechahora'], 'safe'],
            [['planificacion_idplanificacion', 'usuario_idusuario', 'motivo_rechazo_idmotivo_rechazo'], 'required'],
            [['planificacion_idplanificacion', 'usuario_idusuario'], 'integer'],
            [['observacion'], 'string', 'max' => 200],
            [['motivo_rechazo_idmotivo_rechazo'], 'string', 'max' => 45],
            [['motivo_rechazo_idmotivo_rechazo'], 'exist', 'skipOnError' => true, 'targetClass' => MotivosRechazo::className(), 'targetAttribute' => ['motivo_rechazo_idmotivo_rechazo' => 'idmotivo_rechazo']],
            [['planificacion_idplanificacion'], 'exist', 'skipOnError' => true, 'targetClass' => Planificaciones::className(), 'targetAttribute' => ['planificacion_idplanificacion' => 'idplanificacion']],
            [['usuario_idusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_idusuario' => 'id_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idvalidacion' => 'Idvalidacion',
            'fechahora' => 'Fechahora',
            'observacion' => 'Observacion',
            'planificacion_idplanificacion' => 'Planificacion Idplanificacion',
            'usuario_idusuario' => 'Usuario Idusuario',
            'motivo_rechazo_idmotivo_rechazo' => 'Motivo Rechazo Idmotivo Rechazo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMotivoRechazoIdmotivoRechazo()
    {
        return $this->hasOne(MotivosRechazo::className(), ['idmotivo_rechazo' => 'motivo_rechazo_idmotivo_rechazo']);
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
    public function getUsuarioIdusuario()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'usuario_idusuario']);
    }
}
