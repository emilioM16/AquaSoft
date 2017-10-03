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
 * @property string $estados_planificacion_idestado_planificacion
 * @property integer $acuarios_usuarios_acuarios_idacuario
 * @property integer $acuarios_usuarios_usuarios_idusuario
 */
class Planning extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'planificaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'aniomes', 'estados_planificacion_idestado_planificacion', 'acuarios_usuarios_acuarios_idacuario', 'acuarios_usuarios_usuarios_idusuario'], 'required'],
            [['aniomes', 'fechahoracreacion'], 'safe'],
            [['activo', 'acuarios_usuarios_acuarios_idacuario', 'acuarios_usuarios_usuarios_idusuario'], 'integer'],
            [['titulo', 'estados_planificacion_idestado_planificacion'], 'string', 'max' => 45],
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
            'estados_planificacion_idestado_planificacion' => 'Estados Planificacion Idestado Planificacion',
            'acuarios_usuarios_acuarios_idacuario' => 'Acuarios Usuarios Acuarios Idacuario',
            'acuarios_usuarios_usuarios_idusuario' => 'Acuarios Usuarios Usuarios Idusuario',
        ];
    }
}
