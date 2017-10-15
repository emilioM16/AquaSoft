<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "VALIDACION".
 *
 * @property integer $idVALIDACION
 * @property string $FECHAHORA
 * @property string $OBSERVACION
 * @property string $MOTIVO_RECHAZO_idMotivoRechazo
 * @property integer $PLANIFICACION_idPlanificacion
 * @property integer $USUARIO_idUsuario
 *
 * @property MOTIVORECHAZO $mOTIVORECHAZOIdMotivoRechazo
 * @property PLANIFICACION $pLANIFICACIONIdPlanificacion
 * @property USUARIO $uSUARIOIdUsuario
 */
class Validation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'VALIDACION';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FECHAHORA'], 'safe'],
            [['MOTIVO_RECHAZO_idMotivoRechazo', 'PLANIFICACION_idPlanificacion', 'USUARIO_idUsuario'], 'required'],
            [['PLANIFICACION_idPlanificacion', 'USUARIO_idUsuario'], 'integer'],
            [['OBSERVACION'], 'string', 'max' => 200],
            [['MOTIVO_RECHAZO_idMotivoRechazo'], 'string', 'max' => 45],
            [['MOTIVO_RECHAZO_idMotivoRechazo'], 'exist', 'skipOnError' => true, 'targetClass' => MOTIVORECHAZO::className(), 'targetAttribute' => ['MOTIVO_RECHAZO_idMotivoRechazo' => 'idMotivoRechazo']],
            [['PLANIFICACION_idPlanificacion'], 'exist', 'skipOnError' => true, 'targetClass' => PLANIFICACION::className(), 'targetAttribute' => ['PLANIFICACION_idPlanificacion' => 'idPlanificacion']],
            [['USUARIO_idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => USUARIO::className(), 'targetAttribute' => ['USUARIO_idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idVALIDACION' => 'Id Validacion',
            'FECHAHORA' => 'Fechahora',
            'OBSERVACION' => 'Observacion',
            'MOTIVO_RECHAZO_idMotivoRechazo' => 'Motivo  Rechazo Id Motivo Rechazo',
            'PLANIFICACION_idPlanificacion' => 'Planificacion Id Planificacion',
            'USUARIO_idUsuario' => 'Usuario Id Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMOTIVORECHAZOIdMotivoRechazo()
    {
        return $this->hasOne(MOTIVORECHAZO::className(), ['idMotivoRechazo' => 'MOTIVO_RECHAZO_idMotivoRechazo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPLANIFICACIONIdPlanificacion()
    {
        return $this->hasOne(PLANIFICACION::className(), ['idPlanificacion' => 'PLANIFICACION_idPlanificacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUSUARIOIdUsuario()
    {
        return $this->hasOne(USUARIO::className(), ['idUsuario' => 'USUARIO_idUsuario']);
    }
}
