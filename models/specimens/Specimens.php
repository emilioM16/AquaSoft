<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ejemplares".
 *
 * @property integer $especie_idespecie
 * @property integer $acuario_idacuario
 * @property integer $cantidad
 *
 * @property Acuarios $acuarioIdacuario
 * @property Especies $especieIdespecie
 */
class Specimens extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ejemplares';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['especie_idespecie', 'acuario_idacuario', 'cantidad'], 'required'],
            [['especie_idespecie', 'acuario_idacuario', 'cantidad'], 'integer'],
            [['acuario_idacuario'], 'exist', 'skipOnError' => true, 'targetClass' => Acuarios::className(), 'targetAttribute' => ['acuario_idacuario' => 'idacuario']],
            [['especie_idespecie'], 'exist', 'skipOnError' => true, 'targetClass' => Especies::className(), 'targetAttribute' => ['especie_idespecie' => 'idespecie']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'especie_idespecie' => 'Especie Idespecie',
            'acuario_idacuario' => 'Acuario Idacuario',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuarioIdacuario()
    {
        return $this->hasOne(Acuarios::className(), ['idacuario' => 'acuario_idacuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspecieIdespecie()
    {
        return $this->hasOne(Especies::className(), ['idespecie' => 'especie_idespecie']);
    }
}
