<?php

use yii\base\Model; 
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View\Task */
/* @var $model app\models\task\Task */
/* @var $model->condicionAmbiental app\models\condition\EnviromentalConditions */

$this->title = 'Tarea: ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTarea, 'url' => ['view', 'id' => $model->idTarea]];
$this->params['breadcrumbs'][] = 'Execute';
?>
<div class="task-control"> 
    <h4><?= Html::encode($this->title) ?></h4>
    <!-- Áquí el resto de los atributos -->

    <?php
        $form = ActiveForm::begin([
            'id'=>$model->formName(),
            // 'id'=>'UnIdCualquiera',
            'enableAjaxValidation'=>true, //importante, valida si el nombre ya está en uso
            // 'validationUrl'=> Url::toRoute(['task/validationExecute','id'=>$taskId]), 
            'type'=>ActiveForm::TYPE_VERTICAL]);

        // SACAR UNO DE ESTOS (ARRIBA O ABAJO)
        echo $form->field($model, 'titulo')->staticInput();
        
        echo Form::widget([
            'model'=>$model->condicionAmbiental,
            'form'=>$form,
            'columns'=>2,
            'attributes'=>[
                'ph'=>[
                    'type'=>Form::INPUT_TEXT,
                    // 'options'=>[
                    //     // 'placeholder'=>'Ingrese el titulo',
                    //     'maxlength'=>true,
                    // ]                    
                ],
                'temperatura'=>[
                    'type'=>Form::INPUT_TEXT,
                    // 'options'=>[
                    //     // 'placeholder'=>'Ingrese el titulo',
                    //     'maxlength'=>true,
                    // ]                    
                ]
            ]
        ]);
        echo Form::widget([
            'model'=>$model->condicionAmbiental,
            'form'=>$form,
            'columns'=>2,
            'attributes'=>[
                'salinidad'=>[
                    'type'=>Form::INPUT_TEXT,
                    // 'options'=>[
                    //     // 'placeholder'=>'Ingrese el titulo',
                    //     'maxlength'=>true,
                    // ]                    
                ],
                'lux'=>[
                    'type'=>Form::INPUT_TEXT,
                    // 'options'=>[
                    //     // 'placeholder'=>'Ingrese el titulo',
                    //     'maxlength'=>true,
                    // ]                    
                ]
            ]
        ]);

         echo Form::widget([     // nesting attributes together (without labels for children)
            'model'=>$model->condicionAmbiental,
            'form'=>$form,
            'columns'=>1,
            'attributes'=>[
                'salinidad'=>[
                    'type'=>Form::INPUT_WIDGET,
                    'widgetClass'=>'kartik\touchspin\TouchSpin',
                    'pluginOptions' => [
                                    'buttonup_class' => 'btn btn-primary', 
                                    'buttondown_class' => 'btn btn-danger', 
                                    'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>', 
                                    'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
                                ],
                                'options'=>[
                                    'class'=>'input-sm',
                                    'readonly'=>true
                                ]
                    ]
            ]
        ]);

        echo Form::widget([
            'model'=>$model->condicionAmbiental,
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
        $this->render('_supply', [
        'model' => $model,
            ]); // fruta

    ActiveForm::end();
    ?> 

</div>
