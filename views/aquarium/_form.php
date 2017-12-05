<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;
use kartik\switchinput\SwitchInput;
use kartik\switchinput\SwitchInputAsset;
/* @var $this yii\web\View */
/* @var $model app\models\Acuario */
/* @var $form yii\widgets\ActiveForm */

SwitchInputAsset::register($this); 
?>

<div class="acuario-form">

    <?php 
    $aquariumId =-1;

    if ($model->idAcuario!==null){
        $aquariumId = $model->idAcuario;
    }
        $form = ActiveForm::begin([
            'id'=>$model->formName(),
            'enableAjaxValidation'=>true, //importante, valida si el nombre ya está en uso
            'validationUrl'=> Url::toRoute(['aquarium/validation','id'=>$aquariumId]), 
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
                'capacidadMaxima'=>[
                    'type'=>Form::INPUT_WIDGET,
                    'widgetClass'=>'kartik\touchspin\TouchSpin',
                    'options'=>[
                        'class'=>'input-sm',
                        'pluginOptions' => [
                            'buttonup_class' => 'btn btn-primary', 
                            'buttondown_class' => 'btn btn-danger', 
                            'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>', 
                            'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
                        ],
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
                        'placeholder'=>'Ingrese una descripción',
                        'maxlength'=>true,
                    ]
                ]
            ]
        ]);
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>2,
            'attributes'=>[
                'activo'=>[
                    'label'=>'Estado',
                    'type'=>Form::INPUT_WIDGET,
                    'widgetClass'=>'kartik\switchinput\SwitchInput',
                    'options'=>[
                        'type'=>SwitchInput::CHECKBOX,
                        'pluginOptions'=>[
                            'size'=>'mini',
                            'onText'=>'Activo',
                            'offText'=>'Inactivo',
                            'onColor'=>'success',
                            'offColor'=>'danger'
                        ]
                    ]
                ],
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