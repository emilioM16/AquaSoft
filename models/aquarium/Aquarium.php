<?php

namespace app\models\aquarium;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "acuarios".
 *
 * @property integer $idacuario
 * @property string $nombre
 * @property string $descripcion
 * @property integer $capacidad_maxima
 * @property integer $espaciodisponible
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
        return 'acuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'capacidad_maxima','activo'], 'required','message'=>'Campo obligatorio.'],
            [['capacidad_maxima', 'espaciodisponible', 'activo'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 200],
            [['nombre'],'unique','message'=>'El nombre ingresado ya existe.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idacuario' => 'Idacuario',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'capacidad_maxima' => 'Capacidad Maxima',
            'espaciodisponible' => 'Espaciodisponible',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuariosUsuarios()
    {
        return $this->hasMany(AcuariosUsuarios::className(), ['acuario_idacuario' => 'idacuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioIdusuarios()
    {
        return $this->hasMany(Usuarios::className(), ['id_usuario' => 'usuario_idusuario'])->viaTable('acuarios_usuarios', ['acuario_idacuario' => 'idacuario']);
    }


        /**
     * @return \yii\db\ActiveQuery
     */
     public function getCondicionesAmbientales()
     {
         return $this->hasMany(CondicionesAmbientales::className(), ['acuario_idacuario' => 'idacuario']);
     }


         /**
     * @return \yii\db\ActiveQuery
     */
    public function getEjemplares()
    {
        return $this->hasMany(Ejemplares::className(), ['acuario_idacuario' => 'idacuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspecieIdespecies()
    {
        return $this->hasMany(Especies::className(), ['idespecie' => 'especie_idespecie'])->viaTable('ejemplares', ['acuario_idacuario' => 'idacuario']);
    }


    public function beforeSave($insert){
        $this->espaciodisponible = $this->capacidad_maxima;
        return parent::beforeSave($insert);
    }

    public static function getActiveAquariums(){
        $aquariums = static::find()->where(['activo'=>1])->all();
        $items = ArrayHelper::map($aquariums, 'idacuario','nombre');
        return $items;
    }

}
