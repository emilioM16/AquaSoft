<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;
use app\models\User;

class Login extends Model{

  public $username;
  public $password;

  private $_user;

  public function rules(){
    return[
      [['username','password'],'required','message'=>'Campo obligatorio'],
      [['password'],'validarPass'],
    ];
  }

  public function attributeLabels(){
    return[
      'username'=>'Usuario',
      'password'=>'Contraseña',
    ];
  }

  public function validarPass($attribute, $params) {
    if(!$this->hasErrors()){
      $usuario = $this->getUsuario();
      if(!$usuario || !$usuario->validarContrasenia($this->$attribute)){
        $this->addError($attribute, 'El usuario o la contraseña es incorrecto.');
      }
    }
  }


  public function login(){ //valida los datos ingresados usando las reglas , y si son correctos inicia sesión
    if($this->validate()){
      return Yii::$app->user->login($this->getUsuario());
    }
    return false;
  }

  

  protected function getUsuario()
  {
      if ($this->_user === null) {
          $this->_user = User::findByUsername($this->username);
      }

      return $this->_user;
  }


}

 ?>
