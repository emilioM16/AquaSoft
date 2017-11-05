<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use app\models\planning\Planning;
use app\models\planning\Validation;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Planning */


use  kartik\datecontrol\Module ;
use  kartik\datecontrol\DateControl ;

$this->title = $model->titulo;
//$this->title = $modelValidacion->titulo;
$this->params['breadcrumbs'][] = $this->title;
$modelV->PLANIFICACION_idPlanificacion = $model->idPlanificacion;

?>
<div class="planning-view">
  <?php
  $form = ActiveForm::begin([
      'id'=>$modelV->formName(),
      'action' => ['planning/motive','id'=>$modelV->PLANIFICACION_idPlanificacion],
      'type'=>ActiveForm::TYPE_VERTICAL]);

                echo Form::widget([
                    'model'=>$modelV,
                    'form'=>$form,
                    'columns'=>1,
                    'attributes'=>[
                      'MOTIVO_RECHAZO_idMotivoRechazo'=>[
                        'type'=>Form::INPUT_WIDGET,
                        'widgetClass'=>'kartik\select2\Select2',

                        'options'=>[
                          'pluginOptions'=>[
                            'placeholder'=>'Seleccione el motivo',
                          ],
                          'data'=>
                            [
                              'Escasez de tareas',
                              'Incorrecta distribución de tareas',
                              'Incumplimiento de politicas',
                              'Otro'
                            ]
                        ],

                       ],

                      'OBSERVACION'=>[
                            'type'=>Form::INPUT_TEXTAREA,
                            'options'=>[
                                'placeholder'=>'Ingrese una observacion',
                                'maxlength'=>true,
                            ]
                        ],

                         'actions'=>[
                             'type'=>Form::INPUT_RAW,
                             'value'=>'<div class="form-group" align="center">'.
                             Html::submitButton(
                                 $model->isNewRecord ? 'Aceptar' : FA::icon('save')->size(FA::SIZE_LARGE).' Aceptar',
                                 [
                                     'class' => $model->isNewRecord ? 'btn btn-success btnModal' : 'btn btn-primary btnModal'
                                 ])
                         ]
                    ]

  ]);

ActiveForm::end();
?>

</div>
<div>



</div>
