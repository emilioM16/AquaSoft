<?php

namespace app\models\aquarium;

use Yii;

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
            [['nombre', 'capacidad_maxima'], 'required', 'message'=>'Campo obligatorio.'],
            [['activo'],'required','message'=>'Seleccione una opción.'],
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
            'descripcion' => 'Descripción',
            'capacidad_maxima' => 'Capacidad máxima',
            'espaciodisponible' => 'Espacio disponible',
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

    public function beforeSave($insert){
        $this->espaciodisponible = $this->capacidad_maxima;
        return parent::beforeSave($insert);
    }
}
