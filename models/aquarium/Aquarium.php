<?php

namespace app\models\aquarium;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "acuarios".
 *
 * @property integer $idAcuario
 * @property string $nombre
 * @property string $descripcion
 * @property integer $capacidadMaxima
 * @property integer $espacioDisponible
 * @property integer $activo
 *
 * @property AcuariosUsuarios[] $acuariosUsuarios
 * @property Usuarios[] $usuarioIdusuarios
 */
class Aquarium extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ACUARIO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'capacidadMaxima','activo'], 'required','message'=>'Campo obligatorio.'],
            [['capacidadMaxima', 'espacioDisponible', 'activo'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 200],
            [ ['nombre'], 'unique', 'when' => function ($model, $attribute) { 
                return $model->{$attribute} !== static::getAquarium($model->idAcuario)->$attribute; }, 
                'on' => 'update',
                'message'=>'El nombre ingresado ya existe'], //en caso de ser una modificación de datos 
            [['nombre'], 'unique', 'on' => 'create', 'message'=>'El nombre ingresado ya existe'], //en caso de crear un nuevo especialista
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idAcuario' => 'idAcuario',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'capacidadMaxima' => 'Capacidad Maxima',
            'espacioDisponible' => 'EspacioDisponible',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuariosUsuarios()
    {
        return $this->hasMany(AcuariosUsuarios::className(), ['acuario_idAcuario' => 'idAcuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioIdusuarios()
    {
        return $this->hasMany(Usuarios::className(), ['id_usuario' => 'usuario_idusuario'])->viaTable('acuarios_usuarios', ['acuario_idAcuario' => 'idAcuario']);
    }


        /**
     * @return \yii\db\ActiveQuery
     */
     public function getCondicionesAmbientales()
     {
         return $this->hasMany(CondicionesAmbientales::className(), ['acuario_idAcuario' => 'idAcuario']);
     }


         /**
     * @return \yii\db\ActiveQuery
     */
    public function getEjemplares()
    {
        return $this->hasMany(Ejemplares::className(), ['acuario_idAcuario' => 'idAcuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspecieIdespecies()
    {
        return $this->hasMany(Especies::className(), ['idespecie' => 'especie_idespecie'])->viaTable('ejemplares', ['acuario_idAcuario' => 'idAcuario']);
    }

    public function getAquarium($id){
        return static::findOne(['idAcuario'=>$id]);
    }

    public function beforeSave($insert){
        $this->espacioDisponible = $this->capacidadMaxima;
        return parent::beforeSave($insert);
    }

    public static function getActiveAquariums(){
        $aquariums = static::find()->where(['activo'=>1])->all();
        $items = ArrayHelper::map($aquariums, 'idAcuario','nombre');
        return $items;
    }

}
