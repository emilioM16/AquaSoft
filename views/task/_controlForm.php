<?php

use yii\base\Model; 
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url;
use unclead\multipleinput\TabularInput;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View\Task */
/* @var $modelTask app\models\task\Task */
/* @var $modelTask->condicionAmbiental app\models\condition\EnviromentalConditions */

// $this->title = 'Tarea: Controlar acuario';
// $this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
// $this->params['breadcrumbs'][] = 'Execute';
?>
<div class="task-control"> 
    
    <?php

        print_r($supplyModels);
        $conditionId =-1;

        if ($conditionsModel->idCondicionAmbiental!==null){
            $conditionId = $conditionsModel->idCondicionAmbiental;
        }

        echo "<h4>$this->title</h4>";
        $form = ActiveForm::begin([
            'id'=>$conditionsModel->formName(),
            'enableAjaxValidation'=>true, //importante, valida si el nombre ya está en uso
            'validationUrl'=> Url::toRoute(['task/control-validation','id'=>$conditionId]), 
            'type'=>ActiveForm::TYPE_VERTICAL]);

        
        echo Form::widget([
            'model'=>$conditionsModel,
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
            'model'=>$conditionsModel,
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
        
        
    echo TabularInput::widget([
            'id'=>'id',
            'models' => $supplyModels,
            'max'=>6,
            'attributeOptions' => [
                'enableAjaxValidation'      => true,
                'enableClientValidation'    => false,
                'validateOnChange'          => false,
                'validateOnSubmit'          => true,
                'validateOnBlur'            => false,
            ],
            'columns' => [
                [
                    'name'  => 'idInsumo',
                    'title' => 'Insumo',
                    'type'  => Select2::className(),
                    'enableError' => true,
                    'options'=>[
                        'data'=>$availableSupplies,
                        'pluginOptions'=>[
                            'id'=>'selectInsumo',
                            'width'=>'auto',
                            'placeholder' => 'Seleccione un insumo...',
                        ]
                    ]
                ],
                [
                    'name'  => 'quantity',
                    'title' => 'Cantidad',
                    'type'  => \kartik\touchspin\TouchSpin::className(),
                    'enableError' => true,
                    'options' => [
                        'pluginOptions' => [
                            'verticalbuttons' => true,
                            'verticalupclass' => 'glyphicon glyphicon-plus',
                            'verticaldownclass' => 'glyphicon glyphicon-minus',
                            'initval'=>1,
                            'min'=>1,
                        ]
                    ]
                ],
            ],
        ]);
        
        echo Form::widget([
            'model'=>$conditionsModel,
            'form'=>$form,
            'columns'=>1,
            'attributes'=>[
                'actions'=>[
                    'type'=>Form::INPUT_RAW,
                    'value'=>'<div class="form-group" align="center">'.
                        Html::submitButton(FA::icon('check')->size(FA::SIZE_LARGE).' Realizar',
                            [
                                'value'=>Url::to([
                                    'task/control'
                                    ]),
                                'class' => 'btn btn-success btnModal'
                            ]).' '.
                        Html::button(FA::icon('remove')->size(FA::SIZE_LARGE).' Cancelar',['class' => 'btn btn-danger btnModal','data-dismiss'=>'modal'])
                        .'</div>'
                ]
            ]
        ]);
    ActiveForm::end();
    ?> 
    

</div>
