<?php

use yii\base\Model; 
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View\Task */
/* @var $modelTask app\models\task\Task */
/* @var $modelTask->condicionAmbiental app\models\condition\EnviromentalConditions */

$this->title = 'Tarea: Controlar acuario';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Execute';
?>
<div class="task-control"> 
    
    <?php

        $conditionId =-1;

        if ($model->idCondicionAmbiental!==null){
            $conditionId = $model->idCondicionAmbiental;
        }

        echo "<h4>$this->title</h4>";
        $form = ActiveForm::begin([
            'id'=>$model->formName(),
            // 'id'=>'UnIdCualquiera',
            'enableAjaxValidation'=>true, //importante, valida si el nombre ya está en uso
            'validationUrl'=> Url::toRoute(['conditions/validation','id'=>$conditionId]), 
            'type'=>ActiveForm::TYPE_VERTICAL]);

        // // SACAR UNO DE ESTOS (ARRIBA O ABAJO)
        // echo $form->field($model, 'titulo')->staticInput();
        
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>3,
            'attributes'=>[
                'ph'=>[
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
                'temperatura'=>[
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
                'salinidad'=>[
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
            'attributes'=>[
                'lux'=>[
                    'type'=>Form::INPUT_WIDGET,
                    'widgetClass'=>'kartik\touchspin\TouchSpin',
                    'options'=>[
                        'class'=>'input-sm',
                        'pluginOptions' => [
                            'buttonup_class' => 'btn btn-primary', 
                            'buttondown_class' => 'btn btn-danger', 
                            'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>', 
                            'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>',
                            // 'initval' => 0.00,
                            'min' => 0,
                            'max' => 10,
                            'step' => 0.1,
                            'decimals' => 2,
                        ],
                    ]
                    ],
                'CO2'=>[
                    'type'=>Form::INPUT_WIDGET,
                    'widgetClass'=>'kartik\touchspin\TouchSpin',
                    'options'=>[
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
                'actions'=>[
                    'type'=>Form::INPUT_RAW,
                    'value'=>'<div class="form-group" align="center">'.
                        Html::submitButton(
                            $model->isNewRecord ? FA::icon('save')->size(FA::SIZE_LARGE).' Agregar' : FA::icon('save')->size(FA::SIZE_LARGE).' Realizar',
                            [
                                'class' => $model->isNewRecord ? 'btn btn-success btnModal' : 'btn btn-primary btnModal'
                            ]).' '.
                        Html::button(FA::icon('remove')->size(FA::SIZE_LARGE).' Cancelar',['class' => 'btn btn-danger btnModal','data-dismiss'=>'modal'])
                        .'</div>'
                ]
            ]
        ]);

        // la idea de esto es mostrar todos los insumos asociados al tipo de tarea. A esta lista la obtendría de $model->tipoTarea->insumos
        // $this->renderAjax('../taskSupply/_supply', [
        // 'model' => $model,
        //     ]); // fruta

    ActiveForm::end();
    ?> 

</div>
