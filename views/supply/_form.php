<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\supply\Supply */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supply-form">

<?php 
    $supplyId =-1;
    
    if ($model->idInsumo!==null){
        $supplyId = $model->idInsumo;
    }

    $form = ActiveForm::begin([
                'id'=>$model->formName(),
                'enableAjaxValidation'=>true, //importante, valida si el nombre ya está en uso
                'validationUrl'=> Url::toRoute(['supply/validation','id'=>$supplyId]), 
                'type'=>ActiveForm::TYPE_VERTICAL]);

    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        'attributes'=>[
            'nombre'=>[
                'type'=>Form::INPUT_TEXT,
                'options'=>[
                    'placeholder'=>'Ingrese el nombre',
                    'maxlength'=>true,
                ]
            ],
            'stock'=>[
                'type'=>Form::INPUT_WIDGET,
                'widgetClass'=>'kartik\touchspin\TouchSpin',
                'options'=>[
                    'class'=>'input-sm',
                    'pluginOptions' => [
                        'min'=>1,
                        'verticalbuttons' => true,
                        'verticalupclass' => 'glyphicon glyphicon-plus',
                        'verticaldownclass' => 'glyphicon glyphicon-minus',
                    ],
                ]
            ],
        ]
        ]);

        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'options'=>[
                'class'=>'col-lg-6 form-center'
            ],
            'columns'=>1,
            'attributes'=>[
                'TIPO_TAREA_idTipoTarea'=>[
                    'type'=>Form::INPUT_WIDGET,
                    'widgetClass'=>'kartik\select2\Select2',
                    'options'=>[
                            'data'=>ArrayHelper::map($taskTypes,'idTipoTarea','idTipoTarea'),
                            'options'=>['placeholder' => 'Seleccione un tipo de tarea...']
                    ]
                ],
            ]
        ]);

        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>2,
            'attributes'=>[
                'descripcion'=>[
                    'type'=>Form::INPUT_TEXTAREA,
                    'options'=>[
                        'placeholder'=>'Ingrese una descripción',
                        'maxlength'=>true,
                    ]
                ],
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
                                'class' => $model->isNewRecord ? 'btn btn-success btnModal' : 'btn btn-primary btnModal'
                            ]).' '.
                        Html::button(FA::icon('remove')->size(FA::SIZE_LARGE).' Cancelar',['class' => 'btn btn-danger btnModal','data-dismiss'=>'modal'])
                        .'</div>'
                ]
            ]
          ]);
                 
        ActiveForm::end();
?>

</div>
