<?php

namespace app\models\user;

use Yii;
use yii\web\IdentityInterface;
use app\models\AuthAssignment;
use yii\base\Exception;
/**
 * This is the model class for table "usuarios".
 *
 * @property integer $id_usuario
 * @property string $nombre
 * @property string $apellido
 * @property string $nombre_usuario
 * @property string $email
 * @property string $contrasenia
 * @property integer $activo

 * @property AcuariosUsuarios[] $acuariosUsuarios
 * @property Acuarios[] $acuarioIdacuarios
 * @property AuthAssignment[] $authAssignments
 * @property AuthItem[] $itemNames
 * @property Tareas[] $tareas
 * @property Validaciones[] $validaciones
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    public $contrasenia_repeat;

    public $assignedAquariumsIds = []; //conjunto de acuarios que se le asignaron al especialista a través del formulario//

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
            [['nombre', 'apellido', 'nombre_usuario', 'contrasenia','contrasenia_repeat','activo'], 'required', 'message'=>'Campo requerido'],
            [['activo'], 'integer'],
            ['id_usuario','unique'],
            [['nombre', 'apellido', 'nombre_usuario', 'email', 'contrasenia','contrasenia_repeat'], 'string', 'max' => 45],
            [['contrasenia_repeat'], 'compare', 'compareAttribute'=>'contrasenia','message'=>'Las contraseñas deben ser iguales'],
            ['email','email','message'=>'El email ingresado no es válido'],
            [ ['nombre_usuario', 'email'], 'unique', 'when' => function ($model, $attribute) { 
                return $model->{$attribute} !== static::getActualUsername($model->id_usuario)->$attribute; }, 
                'on' => 'update',
                'message'=>'El {attribute} ingresado ya existe'], //en caso de ser una modificación de datos 
            [['nombre_usuario', 'email'], 'unique', 'on' => 'create', 'message'=>'El {attribute} ingresado ya existe'], //en caso de crear un nuevo especialista
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
            'assignedAquariumsIds'=>''
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuariosUsuarios()
    {
        return $this->hasMany(AcuariosUsuarios::className(), ['usuario_idusuario' => 'id_usuario']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAcuarioIdacuarios()
    {
        return $this->hasMany(Acuarios::className(), ['idacuario' => 'acuario_idacuario'])->viaTable('acuarios_usuarios', ['usuario_idusuario' => 'id_usuario']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id_usuario']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getItemNames()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'item_name'])->viaTable('auth_assignment', ['user_id' => 'id_usuario']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTareas()
    {
        return $this->hasMany(Tareas::className(), ['usuario_idusuario' => 'id_usuario']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getValidaciones()
    {
        return $this->hasMany(Validaciones::className(), ['usuario_idusuario' => 'id_usuario']);
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


    public static function getActualUsername($id){
        return static::findIdentity($id);
    }

    public function validateAuthKey($authKey){

    }
  
    public static function findIdentityByAccessToken($token, $type = null){
        return static::findOne(['access_token'=>$token]);
    }

    public function saveUser(){ //guarda utilizando transacciones los datos del usuario (creado o modificado) junto con su rol (especialista)//
        $authModel = new AuthAssignment();
        $transaction = Yii::$app->db->beginTransaction();
        yii::error(\yii\helpers\VarDumper::dumpAsString($this->assignedAquariumsIds));
        try{
            if($this->load(Yii::$app->request->post()) && $this->save()){//si pasa las validaciones y se guarda el modelo user, guarda en authItem el rol y lo asocia. Caso contrario, se hace un rollback //
                $authModel->item_name = 'especialista';
                $authModel->user_id = strval($this->id_usuario);
                if($authModel->save()){
                    $transaction->commit();
                    return true;
                }else{
                    throw new Exception('Ocurrió un error al guardar la información.');
                }
            }else{
                throw new Exception('Ocurrió un error al guardar la información.');
            }
        }catch (Exception $e){
            $transaction->rollback();
        }
        return false;
    }
}
