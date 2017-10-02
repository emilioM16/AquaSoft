<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acuarios".
 *
 * @property integer $idacuario
 * @property string $nombre
 * @property string $descripcion
 * @property integer $espaciodisponible
 * @property integer $activo
 *
 * @property AcuariosUsuarios[] $acuariosUsuarios
 * @property Usuarios[] $usuarioIdusuarios
 * @property CondicionesAmbientales[] $condicionesAmbientales
 * @property Ejemplares[] $ejemplares
 * @property Especies[] $especieIdespecies
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
            [['nombre', 'espaciodisponible','activo'], 'required'],
            [['espaciodisponible', 'activo'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 200],
            [['nombre'], 'unique'], 
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
}
