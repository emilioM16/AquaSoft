<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\task\Task */
/* @var $form yii\widgets\ActiveForm */
$session = Yii::$app->session;
?>

<div class="task-form">
    <?php 
    $taskId =-1;

    if ($model->idTarea!==null){
        $taskId = $model->idTarea;
    }

        $form = ActiveForm::begin([
            'id'=>$model->formName(),
            'enableAjaxValidation'=>true, //importante, valida si el nombre ya está en uso
            // 'validationUrl'=> Url::toRoute(['task/validation','id'=>$taskId]), 
            'validationUrl'=> Url::toRoute(['task/validation',
                                    'id'=>$taskId, 
                                    'idAqua'=>$model->ACUARIO_idAcuario, 
                                    'idPlan'=>$model->PLANIFICACION_idPlanificacion, 
                                    'fechaInicio'=>$model->fechaHoraInicio]),
            'type'=>ActiveForm::TYPE_VERTICAL]);

        // echo field($model, 'fechaHoraInicio', ['readonly' => true]);

        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>1,
            'attributes'=>[
                'titulo'=>[
                    'type'=>Form::INPUT_TEXT,
                    'options'=>[
                        'placeholder'=>'Ingrese el titulo',
                        'readonly' => false,
                        'maxlength'=>true,
                    ]
                ]
            ]
        ]);
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>1,
            'attributes'=>[
                'descripcion'=>[
                    'type'=>Form::INPUT_TEXTAREA,
                    'options'=>[
                        'placeholder'=>'Ingrese una descripción...',
                        'maxlength'=>true,
                    ]
                ]
            ]
        ]);

        echo Form::widget([     // nesting attributes together (without labels for children)
            'model'=>$model,
            'form'=>$form,
            'columns'=>1,
            'attributes'=>[
                'TIPO_TAREA_idTipoTarea'=>[
                    'type'=>Form::INPUT_WIDGET,
                    'widgetClass'=>'kartik\select2\Select2',
                    'options'=>[
                            'data'=>ArrayHelper::map($taskTypes,'idTipoTarea','idTipoTarea'),
                            'options'=>['placeholder' => 'Seleccione un tipo de tarea...']
                        ]
                ]
            ]
        ]);

        echo Form::widget([     // nesting attributes together (without labels for children)
            'model'=>$model,
            'form'=>$form,
            'columns'=>2,
            'attributes'=>[
                'horaInicio'=>[
                           'type'=>Form::INPUT_WIDGET,
                           'widgetClass'=>'kartik\time\TimePicker',
                           'options'=>[
                               'name' => 'DTPhoraInicio',
                               'pluginOptions' => [
                                    // 'defaultTime'=> '00:00 PM',
                                    'showMeridian' => false,
                                    'showSeconds' => false,
                                    'minuteStep' => 10
                                    ],
                               'addonOptions' => [
                                    'asButton' => true,
                                    'buttonOptions' => ['class' => 'btn btn-info']
                                    ]
                                ]
                          ],
                'duracion'=>[
                           'type'=>Form::INPUT_WIDGET,
                           'widgetClass'=>'kartik\time\TimePicker',
                           'options'=>[
                               'name' => 'DTPduracion',
                               'pluginOptions' => [
                                    'defaultTime'=> '00:15 PM',
                                    'showMeridian' => false,
                                    'showSeconds' => false
                                    ],
                               'addonOptions' => [
                                    'asButton' => true,
                                    'buttonOptions' => ['class' => 'btn btn-info']
                                    ]
                                ]
                          ]
            ]
        ]);
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>1,
            'attributes'=>[
                'actions'=>[
                    'type'=>Form::INPUT_RAW,
                    'value'=>'<div class="form-group" align="center">'.

                        Html::submitButton(
                            $model->isNewRecord ? FA::icon('save')->size(FA::SIZE_LARGE).' Agregar' : FA::icon('save')->size(FA::SIZE_LARGE).' Modificar',
                            [
                                'class' => $model->isNewRecord ? 'btn btn-success btnModal' : 'btn btn-success btnModal'
                            ]).' '.

                        Html::button(FA::icon('remove')->size(FA::SIZE_LARGE).' Cancelar',
                        ['class' => 'btn btn-danger btnModal','data-dismiss'=>'modal'
                            ]).' '.

                         Html::a(FA::icon("trash")->size(FA::SIZE_LARGE).' Eliminar', ['task/delete', 'id' => $model->idTarea], [
                                   'class' => 'btn btn-primary btnModal',
                                   'data' => [
                                       'confirm' => '¿Esta seguro que desea eliminar esta tarea?',
                                       'method' => 'post',
                                     ],
                                   ])
                ]
            ]
        ]);
    $form->field($model, 'fechaHoraInicio')->textInput(['hidden' => true]);
    $form->field($model, 'fechaHoraFin')->textInput(['hidden' => true]);
    // $form->field($model, 'PLANIFICACION_idPlanificacion')->textInput(['hidden' => true]);
    // $form->field($model, 'ACUARIO_idAcuario')->textInput(['hidden' => true]);
    ActiveForm::end();
    ?>

</div>
