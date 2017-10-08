<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "EJEMPLAR".
 *
 * @property integer $especie_idEspecie
 * @property integer $acuario_idAcuario
 * @property integer $cantidad
 *
 * @property ACUARIO $acuarioIdAcuario
 * @property ESPECIE $especieIdEspecie
 * @property TAREAEJEMPLAR[] $tAREAEJEMPLARs
 * @property TAREA[] $tAREAIdTareas
 */
class Specimen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'EJEMPLAR';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['especie_idEspecie', 'acuario_idAcuario', 'cantidad'], 'required'],
            [['especie_idEspecie', 'acuario_idAcuario', 'cantidad'], 'integer'],
            [['acuario_idAcuario'], 'exist', 'skipOnError' => true, 'targetClass' => ACUARIO::className(), 'targetAttribute' => ['acuario_idAcuario' => 'idAcuario']],
            [['especie_idEspecie'], 'exist', 'skipOnError' => true, 'targetClass' => ESPECIE::className(), 'targetAttribute' => ['especie_idEspecie' => 'idEspecie']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'especie_idEspecie' => 'Especie Id Especie',
            'acuario_idAcuario' => 'Acuario Id Acuario',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuarioIdAcuario()
    {
        return $this->hasOne(ACUARIO::className(), ['idAcuario' => 'acuario_idAcuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspecieIdEspecie()
    {
        return $this->hasOne(ESPECIE::className(), ['idEspecie' => 'especie_idEspecie']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAREAEJEMPLARs()
    {
        return $this->hasMany(TAREAEJEMPLAR::className(), ['EJEMPLAR_especie_idEspecie' => 'especie_idEspecie', 'EJEMPLAR_acuario_idAcuario' => 'acuario_idAcuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAREAIdTareas()
    {
        return $this->hasMany(TAREA::className(), ['idTarea' => 'TAREA_idTarea'])->viaTable('TAREA_EJEMPLAR', ['EJEMPLAR_especie_idEspecie' => 'especie_idEspecie', 'EJEMPLAR_acuario_idAcuario' => 'acuario_idAcuario']);
    }
}
