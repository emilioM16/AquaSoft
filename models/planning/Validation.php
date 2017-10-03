<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "validaciones".
 *
 * @property integer $idvalidacion
 * @property string $fechahora
 * @property string $observacion
 * @property integer $planificaciones_idplanificacion
 * @property integer $usuarios_idusuario
 * @property string $motivos_rechazo_idmotivo_rechazo
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
            [['planificaciones_idplanificacion', 'usuarios_idusuario', 'motivos_rechazo_idmotivo_rechazo'], 'required'],
            [['planificaciones_idplanificacion', 'usuarios_idusuario'], 'integer'],
            [['observacion'], 'string', 'max' => 200],
            [['motivos_rechazo_idmotivo_rechazo'], 'string', 'max' => 45],
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
            'planificaciones_idplanificacion' => 'Planificaciones Idplanificacion',
            'usuarios_idusuario' => 'Usuarios Idusuario',
            'motivos_rechazo_idmotivo_rechazo' => 'Motivos Rechazo Idmotivo Rechazo',
        ];
    }
}
