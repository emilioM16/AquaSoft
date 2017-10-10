<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TAREA_EJEMPLAR".
 *
 * @property integer $TAREA_idTarea
 * @property integer $EJEMPLAR_especie_idEspecie
 * @property integer $EJEMPLAR_acuario_idAcuario
 * @property integer $cantidad
 *
 * @property EJEMPLAR $eJEMPLAREspecieIdEspecie
 * @property TAREA $tAREAIdTarea
 */
class TaskSpecimen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TAREA_EJEMPLAR';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TAREA_idTarea', 'EJEMPLAR_especie_idEspecie', 'EJEMPLAR_acuario_idAcuario', 'cantidad'], 'required'],
            [['TAREA_idTarea', 'EJEMPLAR_especie_idEspecie', 'EJEMPLAR_acuario_idAcuario', 'cantidad'], 'integer'],
            [['EJEMPLAR_especie_idEspecie', 'EJEMPLAR_acuario_idAcuario'], 'exist', 'skipOnError' => true, 'targetClass' => EJEMPLAR::className(), 'targetAttribute' => ['EJEMPLAR_especie_idEspecie' => 'especie_idEspecie', 'EJEMPLAR_acuario_idAcuario' => 'acuario_idAcuario']],
            [['TAREA_idTarea'], 'exist', 'skipOnError' => true, 'targetClass' => TAREA::className(), 'targetAttribute' => ['TAREA_idTarea' => 'idTarea']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TAREA_idTarea' => 'Tarea Id Tarea',
            'EJEMPLAR_especie_idEspecie' => 'Ejemplar Especie Id Especie',
            'EJEMPLAR_acuario_idAcuario' => 'Ejemplar Acuario Id Acuario',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEJEMPLAREspecieIdEspecie()
    {
        return $this->hasOne(EJEMPLAR::className(), ['especie_idEspecie' => 'EJEMPLAR_especie_idEspecie', 'acuario_idAcuario' => 'EJEMPLAR_acuario_idAcuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAREAIdTarea()
    {
        return $this->hasOne(TAREA::className(), ['idTarea' => 'TAREA_idTarea']);
    }
}
