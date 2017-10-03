<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "especies".
 *
 * @property integer $idespecie
 * @property string $nombre
 * @property string $descripcion
 * @property double $minph
 * @property double $maxph
 * @property double $mintemp
 * @property double $maxtemp
 * @property double $minsalinidad
 * @property double $maxsalinidad
 * @property double $minlux
 * @property double $maxlux
 * @property integer $minespacio
 * @property double $minco2
 * @property double $maxco2
 * @property integer $activo
 */
class Species extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'especies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'minph', 'maxph', 'mintemp', 'maxtemp', 'minsalinidad', 'maxsalinidad', 'minlux', 'maxlux', 'minespacio', 'minco2', 'maxco2'], 'required'],
            [['minph', 'maxph', 'mintemp', 'maxtemp', 'minsalinidad', 'maxsalinidad', 'minlux', 'maxlux', 'minco2', 'maxco2'], 'number'],
            [['minespacio', 'activo'], 'integer'],
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
            'idespecie' => 'Idespecie',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'minph' => 'Minph',
            'maxph' => 'Maxph',
            'mintemp' => 'Mintemp',
            'maxtemp' => 'Maxtemp',
            'minsalinidad' => 'Minsalinidad',
            'maxsalinidad' => 'Maxsalinidad',
            'minlux' => 'Minlux',
            'maxlux' => 'Maxlux',
            'minespacio' => 'Minespacio',
            'minco2' => 'Minco2',
            'maxco2' => 'Maxco2',
            'activo' => 'Activo',
        ];
    }
}
