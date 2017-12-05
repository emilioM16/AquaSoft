<?php 
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
?>

</div class="row">
    <div class="col-lg-12">
        <?php
            $formatter = \Yii::$app->formatter;
            $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
            echo FormGrid::widget([
                'model'=>$task,
                'form'=>$form,
                'autoGenerateColumns'=>true,
                'rows'=>[
                    [
                        'attributes'=>[       // 2 column layout
                            'titulo'=>['type'=>Form::INPUT_STATIC],
                            'TIPO_TAREA_idTipoTarea'=>['type'=>Form::INPUT_STATIC],
                            'planificacionAsociada'=>['type'=>Form::INPUT_STATIC,'staticValue'=>$task->planificacion['titulo']],
                            
                            ]
                    ],
                    [
                        'attributes'=>[       // 2 column layout
                            'fechaHoraInicio'=>['type'=>Form::INPUT_STATIC],
                            'fechaHoraFin'=>['type'=>Form::INPUT_STATIC],
                            ]
                    ],
                    [
                        'attributes'=>[       // 1 column layout
                            'descripcion'=>['type'=>Form::INPUT_STATIC],
                        ],
                    ],
                ]
            ]);
            ActiveForm::end();
            ?>
    </div>
</div>

    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 form-center btnTaskDone'>
        <?= Html::button('Cerrar',['class' => 'btn btn-danger btnModal','data-dismiss'=>'modal'])?>
    </div>