<?php

namespace app\models\task;

use Yii;

/**
 * This is the model class for table "TAREA".
 *
 * @property integer $idTarea
 * @property string $titulo
 * @property string $descripcion
 * @property string $fechaHoraInicio
 * @property string $fechaHoraFin
 * @property string $fechaHoraRealizacion
 * @property integer $PLANIFICACION_idPlanificacion
 * @property integer $USUARIO_idUsuario
 * @property integer $ACUARIO_idAcuario
 * @property string $TIPO_TAREA_idTipoTarea
 *
 * @property CONDICIONAMBIENTAL[] $cONDICIONAMBIENTALs
 * @property INSUMOTAREA[] $iNSUMOTAREAs
 * @property INSUMO[] $iNSUMOIdInsumos
 * @property NOTIFICACION[] $nOTIFICACIONs
 * @property ACUARIO $aCUARIOIdAcuario
 * @property TIPOTAREA $tIPOTAREAIdTipoTarea
 * @property PLANIFICACION $pLANIFICACIONIdPlanificacion
 * @property USUARIO $uSUARIOIdUsuario
 * @property TAREAEJEMPLAR[] $tAREAEJEMPLARs
 * @property EJEMPLAR[] $eJEMPLAREspecieIdEspecies
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TAREA';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'fechaHoraInicio', 'fechaHoraFin', 'TIPO_TAREA_idTipoTarea'], 'required'],
            [['fechaHoraInicio', 'fechaHoraFin', 'fechaHoraRealizacion'], 'safe'],
            [['PLANIFICACION_idPlanificacion', 'USUARIO_idUsuario', 'ACUARIO_idAcuario'], 'integer'],
            [['titulo', 'TIPO_TAREA_idTipoTarea'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 200],
            [['ACUARIO_idAcuario'], 'exist', 'skipOnError' => true, 'targetClass' => ACUARIO::className(), 'targetAttribute' => ['ACUARIO_idAcuario' => 'idAcuario']],
            [['TIPO_TAREA_idTipoTarea'], 'exist', 'skipOnError' => true, 'targetClass' => TIPOTAREA::className(), 'targetAttribute' => ['TIPO_TAREA_idTipoTarea' => 'idTipoTarea']],
            [['PLANIFICACION_idPlanificacion'], 'exist', 'skipOnError' => true, 'targetClass' => PLANIFICACION::className(), 'targetAttribute' => ['PLANIFICACION_idPlanificacion' => 'idPlanificacion']],
            [['USUARIO_idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => USUARIO::className(), 'targetAttribute' => ['USUARIO_idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTarea' => 'Id Tarea',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'fechaHoraInicio' => 'Fecha Hora Inicio',
            'fechaHoraFin' => 'Fecha Hora Fin',
            'fechaHoraRealizacion' => 'Fecha Hora Realizacion',
            'PLANIFICACION_idPlanificacion' => 'Planificacion Id Planificacion',
            'USUARIO_idUsuario' => 'Usuario Id Usuario',
            'ACUARIO_idAcuario' => 'Acuario Id Acuario',
            'TIPO_TAREA_idTipoTarea' => 'Tipo  Tarea Id Tipo Tarea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCONDICIONAMBIENTALs()
    {
        return $this->hasMany(CONDICIONAMBIENTAL::className(), ['tarea_idTarea' => 'idTarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINSUMOTAREAs()
    {
        return $this->hasMany(INSUMOTAREA::className(), ['TAREA_idTarea' => 'idTarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINSUMOIdInsumos()
    {
        return $this->hasMany(INSUMO::className(), ['idInsumo' => 'INSUMO_idInsumo'])->viaTable('INSUMO_TAREA', ['TAREA_idTarea' => 'idTarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOTIFICACIONs()
    {
        return $this->hasMany(NOTIFICACION::className(), ['TAREA_idTarea' => 'idTarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getACUARIOIdAcuario()
    {
        return $this->hasOne(ACUARIO::className(), ['idAcuario' => 'ACUARIO_idAcuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTIPOTAREAIdTipoTarea()
    {
        return $this->hasOne(TIPOTAREA::className(), ['idTipoTarea' => 'TIPO_TAREA_idTipoTarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPLANIFICACIONIdPlanificacion()
    {
        return $this->hasOne(PLANIFICACION::className(), ['idPlanificacion' => 'PLANIFICACION_idPlanificacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUSUARIOIdUsuario()
    {
        return $this->hasOne(USUARIO::className(), ['idUsuario' => 'USUARIO_idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAREAEJEMPLARs()
    {
        return $this->hasMany(TAREAEJEMPLAR::className(), ['TAREA_idTarea' => 'idTarea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEJEMPLAREspecieIdEspecies()
    {
        return $this->hasMany(EJEMPLAR::className(), ['especie_idEspecie' => 'EJEMPLAR_especie_idEspecie', 'acuario_idAcuario' => 'EJEMPLAR_acuario_idAcuario'])->viaTable('TAREA_EJEMPLAR', ['TAREA_idTarea' => 'idTarea']);
    }

    
    public function beforeSave($insert){
        $this->duracion = strtotime($this->duracion)-strtotime("00:00:00");
        $this->hora_fin = date("H:i:s",strtotime($this->hora_inicio)+$this->duracion);
        return parent::beforeSave($insert);
    }
}
