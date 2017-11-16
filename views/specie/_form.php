<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\helpers\Url;
use kartik\switchinput\SwitchInput;
use rmrevin\yii\fontawesome\FA;
/* @var $this yii\web\View */
/* @var $model app\models\specie\Specie */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="specie-form">
  <?php 
    $specieId =-1;
    
    if ($model->idEspecie!==null){
        $specieId = $model->idEspecie;
    }

    $form = ActiveForm::begin([
                'id'=>$model->formName(),
                'enableAjaxValidation'=>true, //importante, valida si el nombre ya está en uso
                'validationUrl'=> Url::toRoute(['specie/validation','id'=>$specieId]), 
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
      'columns'=>2,
      'contentBefore'=> '<legend class="text-info"><small>pH</small></legend>',
      'attributes'=>[
          'minPH'=>[
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
          ],
          'maxPH'=>[
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
          ],
      ]
  ]);

  echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=>2,
    'contentBefore'=> '<legend class="text-info"><small>Temperatura</small></legend>',
    'attributes'=>[
        'minTemp'=>[
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
        ],
        'maxTemp'=>[
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
        ],
    ]
]);

echo Form::widget([
  'model'=>$model,
  'form'=>$form,
  'columns'=>2,
  'contentBefore'=> '<legend class="text-info"><small>Salinidad</small></legend>',
  'attributes'=>[
      'minSalinidad'=>[
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
      ],
      'maxSalinidad'=>[
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
      ],
  ]
]);

echo Form::widget([
  'model'=>$model,
  'form'=>$form,
  'columns'=>2,
  'contentBefore'=> '<legend class="text-info"><small>Iluminación</small></legend>',
  'attributes'=>[
      'minLux'=>[
        'type'=>Form::INPUT_WIDGET,
        'widgetClass'=>'kartik\touchspin\TouchSpin',
        'options'=>[
            'class'=>'input-sm',
            'pluginOptions' => [
              'buttonup_class' => 'btn btn-primary', 
              'buttondown_class' => 'btn btn-danger', 
              'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>', 
              'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>',
              'min' => 0,
              'step' => 0.1,
              'decimals' => 2,
            ],
        ]
      ],
      'maxLux'=>[
        'type'=>Form::INPUT_WIDGET,
        'widgetClass'=>'kartik\touchspin\TouchSpin',
        'options'=>[
            'class'=>'input-sm',
            'pluginOptions' => [
              'buttonup_class' => 'btn btn-primary', 
              'buttondown_class' => 'btn btn-danger', 
              'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>', 
              'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>',
              'min' => 0,
              'step' => 0.1,
              'decimals' => 2,
            ],
        ]
      ],
  ]
]);

echo Form::widget([
  'model'=>$model,
  'form'=>$form,
  'columns'=>2,
  'contentBefore'=> '<legend class="text-info"><small>CO2</small></legend>',
  'attributes'=>[
      'minCO2'=>[
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
      ],
      'maxCO2'=>[
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
      ],
  ]
]);

echo Form::widget([
  'model'=>$model,
  'form'=>$form,
  'columns'=>1,
  'options'=>[
    'class'=>'col-lg-6 form-center'
  ],
  'contentBefore'=> '<legend class="text-info"><small>Espacio</small></legend>',
  'attributes'=>[
      'minEspacio'=>[
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
