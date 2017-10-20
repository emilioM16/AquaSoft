<?php

namespace app\models\user;

use Yii;
use yii\web\IdentityInterface;
use app\models\AuthAssignment;
use app\models\aquarium\UserAquariums;
use yii\base\Exception;
use app\models\aquarium\Aquarium;
/**
 * This is the model class for table "usuarios".
 *
 * @property integer $idUsuario
 * @property string $nombre
 * @property string $apellido
 * @property string $nombreUsuario
 * @property string $email
 * @property string $contrasenia
 * @property integer $activo

 * @property AcuariosUsuarios[] $acuariosUsuarios
 * @property Acuarios[] $acuarioidAcuarios
 * @property AuthAssignment[] $authAssignments
 * @property AuthItem[] $itemNames
 * @property Tareas[] $tareas
 * @property Validaciones[] $validaciones
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    public $contrasenia_repeat;
    private $oldPassword;

    public $assignedAquariumsIds = []; //conjunto de IDs de acuarios que se le asignaron al especialista a través del formulario//
    public $assignedAquariumsNames = [];//conjunto de NOMBRES de acuarios que se le asignaron al especialista a través del formulario//
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USUARIO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'nombreUsuario', 'contrasenia','contrasenia_repeat','activo'], 'required', 'message'=>'Campo obligatorio'],
            [['activo'], 'integer'],
            ['idUsuario','unique'],
            [['nombre', 'apellido', 'nombreUsuario', 'email', 'contrasenia','contrasenia_repeat'], 'string', 'max' => 45],
            [['contrasenia_repeat'], 'compare', 'compareAttribute'=>'contrasenia','message'=>'Las contraseñas deben ser iguales'],
            ['email','email','message'=>'El email ingresado no es válido'],
            [ ['nombreUsuario', 'email'], 'unique', 'when' => function ($model, $attribute) {
                return $model->{$attribute} !== static::findOne(['idUsuario'=>$model->idUsuario])->$attribute; },
                'on' => 'update',
                'message'=>'El {attribute} ingresado ya existe'], //en caso de ser una modificación de datos
            [['nombreUsuario', 'email'], 'unique', 'on' => 'create', 'message'=>'El {attribute} ingresado ya existe'], //en caso de crear un nuevo especialista
            ['assignedAquariumsIds', 'each', 'rule' => [
                'exist', 'targetClass' => Aquarium::className(), 'targetAttribute' => 'idAcuario'
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUsuario' => 'Id Usuario',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'nombreUsuario' => 'Nombre de usuario',
            'email' => 'Email',
            'contrasenia' => 'Contraseña',
            'contrasenia_repeat'=>'Repetir contraseña',
            'activo' => 'Activo',
            'assignedAquariumsIds'=>'',
            'assignedAquariumsNames'=>'Aquarios asignados'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAquariums()
    {
        return $this->hasMany(UserAquariums::className(), ['usuario_idUsuario' => 'idUsuario']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAquariums()
    {
          if ($this->getRole()=='administrador') {
            return Aquarium::find()->all();
          }else {
            return $this->hasMany(Aquarium::className(), ['idAcuario' => 'acuario_idAcuario'])->viaTable('acuarios_usuarios', ['usuario_idUsuario' => 'idUsuario']);
          }


        }
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'idUsuario']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getItemNames()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'item_name'])->viaTable('auth_assignment', ['user_id' => 'idUsuario']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTareas()
    {
        return $this->hasMany(Task::className(), ['usuario_idUsuario' => 'idUsuario']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getValidaciones()
    {
        return $this->hasMany(Validation::className(), ['usuario_idUsuario' => 'idUsuario']);
    }


    public static function findIdentity($id){
        return static::findOne(['idUsuario' => $id]);
    }


    public static function findByUsername($nombreUsuario){
        return static::findOne(['nombreUsuario'=>$nombreUsuario]);
    }


    public function validarcontrasenia ($pass){ //valida la contraseña hasheada en la bd con la ingresada
        return Yii::$app->security->validatePassword($pass,$this->contrasenia);//si la contrasenia  es correcta devuelve true
    }

    public function afterFind(){
        $this->oldPassword = $this->contrasenia;
    }


    public function beforeSave($insert) { //antes de almacenar la contrasenia  la hashea
        if((isset($this->contrasenia))&&($this->oldPassword!=$this->contrasenia)){
            $this->contrasenia  = Yii::$app->security->generatePasswordHash($this->contrasenia);
        }
        return parent::beforeSave($insert);
    }


    public function getId(){
        return $this->getPrimaryKey();
    }


    public function getAuthKey(){

    }

    public static function getRole(){
        // if user can have only one role
        return current( \Yii::$app->authManager->getAssignments(Yii::$app->user->identity->idUsuario))->roleName;
    }


    public function validateAuthKey($authKey){

    }

    public static function findIdentityByAccessToken($token, $type = null){
        return static::findOne(['access_token'=>$token]);
    }


    public function loadAssignedAquariums(){
        $this->assignedAquariumsIds = [];
        $aquariums = UserAquariums::find()->where(['usuario_idUsuario'=>$this->idUsuario])->all();
        foreach ($aquariums as $a) {
            $this->assignedAquariumsIds[] = $a->acuario_idAcuario;
            $this->assignedAquariumsNames[] = Aquarium::findOne($a->acuario_idAcuario)->nombre;
        }
    }

    public function saveAssignedAquariums(){
        UserAquariums::deleteAll(['usuario_idUsuario'=>$this->idUsuario]);
        if(is_array($this->assignedAquariumsIds)){
            foreach ($this->assignedAquariumsIds as $aqId) {
                $ua = new UserAquariums();
                $ua->usuario_idUsuario = $this->idUsuario;
                $ua->acuario_idAcuario = $aqId;
                $ua->save();
            }
        }
    }

    public function saveUser(){ //guarda utilizando transacciones los datos del usuario (creado o modificado) junto con su rol (especialista)//
        $authModel = new AuthAssignment();
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $this->activo = 1;
            if($this->load(Yii::$app->request->post()) && $this->save()){//si pasa las validaciones y se guarda el modelo user, guarda en authItem el rol y lo asocia. Caso contrario, se hace un rollback //
                $authModel->item_name = 'especialista';
                $authModel->user_id = strval($this->idUsuario);
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


    public function changeActiveState(){//cambia el estado del usuario según corresponda//
        if ($this->activo==0){
            $this->activo = 1;
        }else{
            $this->activo = 0;
        }
        $this->save(false);
    }

}
