<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use app\models\planning\Planning;
use app\models\planning\Validation;
use app\models\planning\RejectedMotive;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Planning */


use  kartik\datecontrol\Module ;
use  kartik\datecontrol\DateControl ;

$this->title = $model->titulo;
//$this->title = $modelValidacion->titulo;
$this->params['breadcrumbs'][] = $this->title;




?>
<div class="planning-view">
  <?php
  $form = ActiveForm::begin([
      'id'=>$modelV->formName(),
      'action' => ['planning/motive','id'=>$model->idPlanificacion],
      'type'=>ActiveForm::TYPE_VERTICAL]);

                echo Form::widget([
                    'model'=>$modelV,
                    'form'=>$form,
                    'columns'=>1,
                    'attributes'=>[
                      'MOTIVO_RECHAZO_idMotivoRechazo'=>[
                        'type'=>Form::INPUT_WIDGET,
                        'widgetClass'=>'kartik\select2\Select2',
                        'options'=>['data'=>ArrayHelper::map($motivos,'idMotivoRechazo','idMotivoRechazo')],
                       ],

                      'OBSERVACION'=>[
                            'type'=>Form::INPUT_TEXTAREA,
                            'options'=>[
                                'placeholder'=>'Ingrese una observación',
                                'maxlength'=>true,
                            ]
                        ],
                         'actions'=>[
                             'type'=>Form::INPUT_RAW,
                             'value'=>'<div class="form-group" align="center">'.
                             Html::submitButton(FA::icon('save')->size(FA::SIZE_LARGE).' Aceptar',
                                 [
                                     'class' => $modelV->isNewRecord ? 'btn btn-success btnModal' : 'btn btn-primary btnModal'
                                 ]).
                            Html::button(FA::icon('remove')->size(FA::SIZE_LARGE).' Cancelar',
                            ['class' => 'btn btn-danger btnModal','data-dismiss'=>'modal'])
                         ]
                    ]
  ]);

ActiveForm::end();
?>

</div>
<div>



</div>
