<?php

namespace app\models\planning;
use app\models\user\User;

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
 * @property RejectedMotive $mOTIVORECHAZOIdMotivoRechazo
 * @property Planning $pLANIFICACIONIdPlanificacion
 * @property User $uSUARIOIdUsuario
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
            [['MOTIVO_RECHAZO_idMotivoRechazo'], 'required','message'=>'Por favor, seleccione un motivo'],
            [['PLANIFICACION_idPlanificacion', 'USUARIO_idUsuario'], 'integer'],
            [['OBSERVACION'], 'string', 'max' => 200],
            [['MOTIVO_RECHAZO_idMotivoRechazo'], 'string', 'max' => 45],
            [['MOTIVO_RECHAZO_idMotivoRechazo'], 'exist', 'skipOnError' => true, 'targetClass' => RejectedMotive::className(), 'targetAttribute' => ['MOTIVO_RECHAZO_idMotivoRechazo' => 'idMotivoRechazo']],
          //  [['PLANIFICACION_idPlanificacion'], 'exist', 'skipOnError' => true, 'targetClass' => Planning::className(), 'targetAttribute' => ['PLANIFICACION_idPlanificacion' => 'idPlanificacion']],
            [['USUARIO_idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['USUARIO_idUsuario' => 'idUsuario']],
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
            'MOTIVO_RECHAZO_idMotivoRechazo' => 'Motivo de rechazo',
            'PLANIFICACION_idPlanificacion' => 'Planificacion Id Planificacion',
            'USUARIO_idUsuario' => 'Usuario Id Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMOTIVORECHAZOIdMotivoRechazo()
    {
        return $this->hasOne(RejectedMotive::className(), ['idMotivoRechazo' => 'MOTIVO_RECHAZO_idMotivoRechazo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPLANIFICACIONIdPlanificacion()
    {
        return $this->hasOne(Planning::className(), ['idPlanificacion' => 'PLANIFICACION_idPlanificacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUSUARIOIdUsuario()
    {
        return $this->hasOne(User::className(), ['idUsuario' => 'USUARIO_idUsuario']);
    }





}
