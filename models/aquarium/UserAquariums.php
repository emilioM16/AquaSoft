<?php

namespace app\models\aquarium;

use Yii;
use app\models\user\User;
/**
 * This is the model class for table "acuarios_usuarios".
 *
 * @property integer $acuario_idacuario
 * @property integer $usuario_idusuario
 *
 * @property Acuarios $acuarioIdacuario
 * @property Usuarios $usuarioIdusuario
 */
class UserAquariums extends \yii\db\ActiveRecord
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
            [['acuario_idacuario'], 'exist', 'skipOnError' => true, 'targetClass' => Aquarium::className(), 'targetAttribute' => ['acuario_idacuario' => 'idacuario']],
            [['usuario_idusuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_idusuario' => 'id_usuario']],
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
        return $this->hasOne(Aquarium::className(), ['idacuario' => 'acuario_idacuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioIdusuario()
    {
        return $this->hasOne(User::className(), ['id_usuario' => 'usuario_idusuario']);
    }

}
