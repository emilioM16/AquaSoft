<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use app\models\AuthAssignment;

/**
 * This is the model class for table "USUARIO".
 *
 * @property integer $id_usuario
 * @property string $nombre
 * @property string $apellidos
 * @property string $nombre_usuario
 * @property string $email
 * @property string $contrasenia
 * @property integer $activo
 *
 * @property ACUARIOUSUARIO[] $aCUARIOUSUARIOs
 * @property ACUARIO[] $aCUARIOIdACUARIOs
 * @property TAREA[] $tAREAs
 * @property VALIDACION[] $vALIDACIONs
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    public $contrasenia_repeat;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'nombre_usuario', 'contrasenia','contrasenia_repeat'], 'required', 'message'=>'Campo requerido.'],
            [['activo'], 'integer'],
            [['nombre', 'apellido', 'nombre_usuario', 'email', 'contrasenia','contrasenia_repeat'], 'string', 'max' => 45],
            [['contrasenia_repeat'], 'compare', 'compareAttribute'=>'contrasenia','message'=>'Las contraseñas deben ser iguales.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'nombre_usuario' => 'Nombre de usuario',
            'email' => 'Email',
            'contrasenia' => 'Contraseña',
            'contrasenia_repeat'=>'Repetir contraseña',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getACUARIOUSUARIOs()
    {
        return $this->hasMany(ACUARIOUSUARIO::className(), ['USUARIO_idUSUARIO' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getACUARIOIdACUARIOs()
    {
        return $this->hasMany(ACUARIO::className(), ['idACUARIO' => 'ACUARIO_idACUARIO'])->viaTable('ACUARIO_USUARIO', ['USUARIO_idUSUARIO' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAREAs()
    {
        return $this->hasMany(TAREA::className(), ['USUARIO_idUSUARIO' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVALIDACIONs()
    {
        return $this->hasMany(VALIDACION::className(), ['USUARIO_idUSUARIO' => 'id_usuario']);
    }


    
    public static function findIdentity($id){
        return static::findOne(['id_usuario' => $id]);
    }


    public static function findByUsername($nombre_usuario){
        return static::findOne(['nombre_usuario'=>$nombre_usuario]);
    }


    public function validarcontrasenia ($pass){ //valida la contraseña hasheada en la bd con la ingresada
        return Yii::$app->security->validatePassword($pass,$this->contrasenia);//si la contrasenia  es correcta devuelve true
    }


    public function beforeSave($insert) { //antes de almacenar la contrasenia  la hashea
        if(isset($this->contrasenia)){
            $this->contrasenia  = Yii::$app->security->generatePasswordHash($this->contrasenia);
        }
        return parent::beforeSave($insert);
    }


    public function getId(){
        return $this->getPrimaryKey();
    }

  
    public function getAuthKey(){

    }

    public static function getRole($id){
        // if user can have only one role
        return current( \Yii::$app->authManager->getAssignments($id) );
    }


    public function validateAuthKey($authKey){

    }
  
    public static function findIdentityByAccessToken($token, $type = null){
        return static::findOne(['access_token'=>$token]);
    }
}
