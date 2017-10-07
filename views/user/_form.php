<?php

use yii\helpers\Html;

use softark\duallistbox\DualListbox;
use app\models\aquarium\Aquarium;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

<?php 

    $userId =-1;

    if ($model->idUsuario!==null){
        $userId = $model->idUsuario;
    }

        $form = ActiveForm::begin([
            'id'=>$model->formName(),
            'enableAjaxValidation'=>true, //importante, valida si el nombre ya está en uso
            'validationUrl'=> Url::toRoute(['user/validation','id'=>$userId]), 
            'type'=>ActiveForm::TYPE_VERTICAL]);

        echo FormGrid::widget([
            'model'=>$model,
            'form'=>$form,
            'autoGenerateColumns'=>true,
            'rows'=>[
                [
                    'contentBefore'=>'<legend class="text-info"><small>Datos del especialista</small></legend>',
                    'attributes'=>[
                        'nombre'=>[
                            'type'=>Form::INPUT_TEXT,
                            'options'=>[
                                'placeholder'=>'Ingrese el nombre'
                            ]
                        ],
                        'apellido'=>[
                            'type'=>Form::INPUT_TEXT,
                            'options'=>[
                                'placeholder'=>'Ingrese el apellido'
                            ]
                        ],
                        'nombreUsuario'=>[
                            'type'=>Form::INPUT_TEXT,
                            'options'=>[
                                'placeholder'=>'Ingrese el nombre de usuario'
                            ]
                        ]
                    ]
                ],
                [
                    'attributes'=>[
                        'email'=>[
                            'type'=>Form::INPUT_TEXT,
                            'options'=>[
                                'placeholder'=>'Ingrese el email'
                            ]
                        ],
                        'contrasenia'=>[
                            'type'=>Form::INPUT_PASSWORD,
                            'options'=>[
                                'placeholder'=>'Ingrese la contraseña'
                            ]
                        ],
                        'contrasenia_repeat'=>[
                            'type'=>Form::INPUT_PASSWORD,
                            'options'=>[
                                'placeholder'=>'Repita la contraseña'
                            ]
                        ],                        
                    ]
                ],
                [
                    'attributes'=>[
                        'activo'=>[
                            'type'=>Form::INPUT_RADIO_LIST,
                            'items'=>[1=>'Activo',0=>'Inactivo'],
                            'options'=>['inline'=>true]
                        ]
                    ]
                ]
            ]
        ]);



        echo FormGrid::widget([
            'model'=>$model,
            'form'=>$form,
            'autoGenerateColumns'=>true,
            'rows'=>[
                [
                    'contentBefore'=>'<legend class="text-info"><small>Asignación de acuarios</small></legend>',
                    'attributes'=>[
                        'assignedAquariumsIds'=>[
                            'type'=>Form::INPUT_WIDGET,
                            'widgetClass'=>'softark\duallistbox\DualListbox',
                            'options'=>[
                                'items' => Aquarium::getActiveAquariums(),
                                'clientOptions' => [
                                    'moveOnSelect' => true,
                                    'selectedListLabel' => 'Acuarios asignados',
                                    'nonSelectedListLabel' => 'Acuarios disponibles',
                                ],
                            ]
                        ]
                    ]
                ],
                [
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
                ]   
            ]
        ]);

 
    ActiveForm::end();
    ?>






</div>