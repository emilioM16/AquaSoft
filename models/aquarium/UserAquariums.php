<?php

namespace app\models\aquarium;

use Yii;
use app\models\user\User;
/**
 * This is the model class for table "acuarios_usuarios".
 *
 * @property integer $acuario_idAcuario
 * @property integer $usuario_idUsuario
 *
 * @property Acuarios $acuarioIdAcuario
 * @property Usuarios $usuarioIdUsuario
 */
class UserAquariums extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ACUARIO_USUARIO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acuario_idAcuario', 'usuario_idUsuario'], 'required'],
            [['acuario_idAcuario', 'usuario_idUsuario'], 'integer'],
            [['acuario_idAcuario'], 'exist', 'skipOnError' => true, 'targetClass' => Aquarium::className(), 'targetAttribute' => ['acuario_idAcuario' => 'idAcuario']],
            [['usuario_idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'acuario_idAcuario' => 'Acuario IdAcuario',
            'usuario_idUsuario' => 'Usuario IdUsuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuarioIdAcuario()
    {
        return $this->hasOne(Aquarium::className(), ['idAcuario' => 'acuario_idAcuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioIdUsuario()
    {
        return $this->hasOne(User::className(), ['idUsuario' => 'usuario_idUsuario']);
    }

}
