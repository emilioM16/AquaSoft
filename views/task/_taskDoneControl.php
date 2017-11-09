<?php 
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
?>

<br>
<div class="row">
    <div class="col-lg-12" form-center" align="center"">
        <?php
            $formatter = \Yii::$app->formatter;
            $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
            echo FormGrid::widget([
                'model'=>$conditions,
                'form'=>$form,
                'autoGenerateColumns'=>true,
                'rows'=>[
                    [
                        'contentBefore'=>'<h5 class="text-center"><b>Condiciones ambientales ingresadas</b></h5>',
                        'attributes'=>[       // 2 column layout
                            'temperatura'=>[
                                'type'=>Form::INPUT_STATIC,
                                'options'=>['class'=>'conditionNumber'],
                                'columnOptions'=>['colspan'=>2]
                            ],
                            'ph'=>[
                                'type'=>Form::INPUT_STATIC,
                                'options'=>['class'=>'conditionNumber'],
                                'columnOptions'=>['colspan'=>2]
                            ],
                            'salinidad'=>[
                                'type'=>Form::INPUT_STATIC,
                                'options'=>['class'=>'conditionNumber'],
                                'columnOptions'=>['colspan'=>2]
                            ],
                            'lux'=>[
                                'type'=>Form::INPUT_STATIC,
                                'options'=>['class'=>'conditionNumber'],
                                'columnOptions'=>['colspan'=>3]
                            ],
                            'CO2'=>[
                                'type'=>Form::INPUT_STATIC,
                                'options'=>['class'=>'conditionNumber'],
                                'columnOptions'=>['colspan'=>3]
                            ],
                            ]
                    ],
                ]
            ]);
            ActiveForm::end();
        ?>
    </div>
</div>