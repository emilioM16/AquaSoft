<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ejemplares".
 *
 * @property integer $especies_idespecie
 * @property integer $acuarios_idacuario
 * @property integer $cantidad
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
            [['especies_idespecie', 'acuarios_idacuario', 'cantidad'], 'required'],
            [['especies_idespecie', 'acuarios_idacuario', 'cantidad'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'especies_idespecie' => 'Especies Idespecie',
            'acuarios_idacuario' => 'Acuarios Idacuario',
            'cantidad' => 'Cantidad',
        ];
    }
}
