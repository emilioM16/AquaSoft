<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TIPO_TAREA".
 *
 * @property string $idTipoTarea
 *
 * @property INSUMO[] $iNSUMOs
 * @property TAREA[] $tAREAs
 */
class TaskType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TIPO_TAREA';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTipoTarea'], 'required'],
            [['idTipoTarea'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoTarea' => 'Id Tipo Tarea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINSUMOs()
    {
        return $this->hasMany(INSUMO::className(), ['TIPO_TAREA_idTipoTarea' => 'idTipoTarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAREAs()
    {
        return $this->hasMany(TAREA::className(), ['TIPO_TAREA_idTipoTarea' => 'idTipoTarea']);
    }
}
