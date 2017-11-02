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
?>
<div class="task-control"> 
    
    <?php

        echo "<h4>$this->title</h4>";
        $form = ActiveForm::begin([
            'id'=>$taskModel->formName(),
            'enableAjaxValidation'=>true, //importante, valida si el nombre ya está en uso
            'validationUrl'=> Url::toRoute(['task/common-tasks-validation']), 
            'type'=>ActiveForm::TYPE_VERTICAL]);


        echo Form::widget([
            'model'=>$taskModel,
            'form'=>$form,
            'columns'=>1,
            'attributes'=>[
                'observaciones'=>[
                    'type'=>Form::INPUT_TEXTAREA,
                    'options'=>[
                        'placeholder'=>'Observaciones...',
                        'maxlength'=>true,
                    ]
                ]
            ]
        ]);
        
 echo '<legend class="text-info"><small>Insumos utilizados</small></legend>';
        
    echo TabularInput::widget([
            'id'=>'id',
            'models' => $supplyModels,
            'max'=>6,
            'allowEmptyList' => true,
            'min'=>0,
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
                            // 'initval'=>0,
                            'min'=>1,
                        ]
                    ]
                ],
            ],
        ]);
        
        echo Form::widget([
            'model'=>$taskModel,
            'form'=>$form,
            'columns'=>1,
            'attributes'=>[
                'actions'=>[
                    'type'=>Form::INPUT_RAW,
                    'value'=>'<div class="form-group" align="center">'.
                        Html::submitButton(FA::icon('check')->size(FA::SIZE_LARGE).' Aceptar',
                            [
                                'value'=>Url::to([
                                    'task/common-tasks-realization',
                                    'idTarea'=>$idTarea
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
    <div id="controlAlert"></div>

</div>
