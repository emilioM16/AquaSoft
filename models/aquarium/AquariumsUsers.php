<?php

namespace app\models\aquarium;

use Yii;

/**
 * This is the model class for table "acuarios_usuarios".
 *
 * @property integer $acuario_idacuario
 * @property integer $usuario_idusuario
 *
 * @property Acuarios $acuarioIdacuario
 * @property Usuarios $usuarioIdusuario
 */
class AquariumsUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acuarios_usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acuario_idacuario', 'usuario_idusuario'], 'required'],
            [['acuario_idacuario', 'usuario_idusuario'], 'integer'],
            [['acuario_idacuario'], 'exist', 'skipOnError' => true, 'targetClass' => Acuarios::className(), 'targetAttribute' => ['acuario_idacuario' => 'idacuario']],
            [['usuario_idusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_idusuario' => 'id_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'acuario_idacuario' => 'Acuario Idacuario',
            'usuario_idusuario' => 'Usuario Idusuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuarioIdacuario()
    {
        return $this->hasOne(Acuarios::className(), ['idacuario' => 'acuario_idacuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioIdusuario()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'usuario_idusuario']);
    }
}
