<?php

namespace app\models\notification;

use Yii;
use rmrevin\yii\fontawesome\FA;
use app\models\task\Task;
use app\models\aquarium\Aquarium;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "NOTIFICACION".
 *
 * @property integer $idNOTIFICACION
 * @property string $fechaHora
 * @property string $ORIGEN_NOTIFICACION_idOrigenNotificacion
 * @property integer $TAREA_idTarea
 *
 * @property ORIGENNOTIFICACION $oRIGENNOTIFICACIONIdOrigenNotificacion
 * @property TAREA $tAREAIdTarea
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'NOTIFICACION';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fechaHora'], 'safe'],
            [['ORIGEN_NOTIFICACION_idOrigenNotificacion', 'TAREA_idTarea'], 'required'],
            [['TAREA_idTarea'], 'integer'],
            [['ORIGEN_NOTIFICACION_idOrigenNotificacion'], 'string', 'max' => 45],
            [['ORIGEN_NOTIFICACION_idOrigenNotificacion'], 'exist', 'skipOnError' => true, 'targetClass' => NotificationOrigin::className(), 'targetAttribute' => ['ORIGEN_NOTIFICACION_idOrigenNotificacion' => 'idOrigenNotificacion']],
            [['TAREA_idTarea'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['TAREA_idTarea' => 'idTarea']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idNOTIFICACION' => 'Id Notificacion',
            'fechaHora' => 'Fecha Hora',
            'ORIGEN_NOTIFICACION_idOrigenNotificacion' => 'Origen  Notificacion Id Origen Notificacion',
            'TAREA_idTarea' => 'Tarea Id Tarea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getORIGENNOTIFICACIONIdOrigenNotificacion()
    {
        return $this->hasOne(NotificationOrigin::className(), ['idOrigenNotificacion' => 'ORIGEN_NOTIFICACION_idOrigenNotificacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAREAIdTarea()
    {
        return $this->hasOne(Task::className(), ['idTarea' => 'TAREA_idTarea']);
    }


    public static function getNotificaciones()
    {   
        $row='';
        $noti = Notification::find()->all();
        foreach ($noti as $key)
         {
            $tarea = Task::findOne($key->TAREA_idTarea);
            $acu = Aquarium::findOne($tarea->ACUARIO_idAcuario);

            if ($key->ORIGEN_NOTIFICACION_idOrigenNotificacion == 'Tarea no realizada')
            {
                $row .= '<p class="alert alert-info alert-notif" role="alert">'.FA::icon("info")->size(FA::SIZE_LARGE).' <strong>¡Atención! </strong>'.$key->ORIGEN_NOTIFICACION_idOrigenNotificacion.' de tipo <strong>'.$tarea->TIPO_TAREA_idTipoTarea.'</strong> en '.$acu->nombre;
                    '</p>'.'<hr class="hrNotif">';
            }
            else
            {
                 $row .= '<p class="alert alert-danger alert-notif text-justify " role="alert">'.FA::icon("warning")->size(FA::SIZE_LARGE).'<strong>¡Peligro! </strong>'.$key->ORIGEN_NOTIFICACION_idOrigenNotificacion.' en el registro de una tarea de tipo <strong>'.$tarea->TIPO_TAREA_idTipoTarea.' </strong>en '.$acu->nombre;
                          '</p>'.'<hr class="hrNotif">';
            } 
         }
        return $row;
    } 

}
