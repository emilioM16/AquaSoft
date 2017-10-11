<?php

namespace app\models\specie;

use Yii;
use app\models\specimen\Specimen;
use app\models\aquarium\Aquarium;

/**
 * This is the model class for table "ESPECIE".
 *
 * @property integer $idEspecie
 * @property string $nombre
 * @property string $descripcion
 * @property double $minPH
 * @property double $maxPH
 * @property double $minTemp
 * @property double $maxTemp
 * @property double $minSalinidad
 * @property double $maxSalinidad
 * @property double $minLux
 * @property double $maxLux
 * @property integer $minEspacio
 * @property double $minCO2
 * @property double $maxCO2
 * @property integer $activo
 *
 * @property Specimen[] $eJEMPLARs
 * @property Aquarium[] $acuarioIdAcuarios
 */
class Specie extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ESPECIE';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'minPH', 'maxPH', 'minTemp', 'maxTemp', 'minSalinidad', 'maxSalinidad', 'minLux', 'maxLux', 'minEspacio', 'minCO2', 'maxCO2'], 'required'],
            [['minPH', 'maxPH', 'minTemp', 'maxTemp', 'minSalinidad', 'maxSalinidad', 'minLux', 'maxLux', 'minCO2', 'maxCO2'], 'number'],
            [['minEspacio', 'activo'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idEspecie' => 'Id Especie',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'minPH' => 'Min Ph',
            'maxPH' => 'Max Ph',
            'minTemp' => 'Min Temp',
            'maxTemp' => 'Max Temp',
            'minSalinidad' => 'Min Salinidad',
            'maxSalinidad' => 'Max Salinidad',
            'minLux' => 'Min Lux',
            'maxLux' => 'Max Lux',
            'minEspacio' => 'Min Espacio',
            'minCO2' => 'Min Co2',
            'maxCO2' => 'Max Co2',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecimens()
    {
        return $this->hasMany(Specimen::className(), ['especie_idEspecie' => 'idEspecie']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuarioIdAcuarios()
    {
        return $this->hasMany(Aquarium::className(), ['idAcuario' => 'acuario_idAcuario'])->viaTable('EJEMPLAR', ['especie_idEspecie' => 'idEspecie']);
    }
}
