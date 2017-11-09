<?php 
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
// print_r($task);
?>


<div class="row">
    <div class="col-lg-2 form-center">
        <?= Html::img('@web/img/clipboard.svg',['class'=>' img-responsive'])?>
    </div>
    <div class='col-lg-8 form-center'>
    <p id='taskDoneText' align="center">¡Tarea realizada!</p>
    </div>
</div>

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
                        'contentBefore'=>'<legend class="text-info"><small>Información de la tarea</small></legend>',
                        'attributes'=>[       // 2 column layout
                            'titulo'=>['type'=>Form::INPUT_STATIC],
                            'fechaHoraInicio'=>['type'=>Form::INPUT_STATIC],
                            'fechaHoraFin'=>['type'=>Form::INPUT_STATIC],
                            ]
                    ],
                    [
                        'attributes'=>[       // 1 column layout
                            'descripcion'=>['type'=>Form::INPUT_STATIC],
                        ],
                    ],
                    [
                        'attributes'=>[       // 1 column layout
                            'planificacionAsociada'=>['type'=>Form::INPUT_STATIC,'staticValue'=>$task->planificacion['titulo']],
                        ],
                    ],
                    [
                        'contentBefore'=>'<legend class="text-info"><small>Información de la realización</small></legend>',
                        'attributes'=>[       // 2 column layout
                            'fechaHoraRealizacion'=>['type'=>Form::INPUT_STATIC],
                            'realizador'=>['type'=>Form::INPUT_STATIC,'staticValue'=>$task->usuarioRealiza['nombre'].' '.$task->usuarioRealiza['apellido']]
                            ]
                    ],
                    [
                        'attributes'=>[
                            'observaciones'=>['type'=>Form::INPUT_STATIC],
                        ]
                    ],
                ]
            ]);
            ActiveForm::end();
            ?>
    </div>
</div>

<div class="row" align="center">
    <div class="col-lg-12 form-center">
        <h5 class="text-center"><b>Insumos utilizados</b></h5>
        <table class="table table-striped table-bordered">
            <tr class="info">
                <th>Nombre</th>
                <th>Cantidad</th> 
            </tr>
            <?php
                $insumos = $task->insumoTareas;
                if(!empty($insumos)){
                    foreach ($insumos as $key => $insumo) {
                     echo '<tr>
                        <td>'.$insumo->insumo['nombre'].'</td> 
                        <td>'.$insumo->cantidad.'</td>
                    </tr>';
                    }
                }

            ?>
        </table>
    </div>
</div>

<?= $this->render('_taskDoneControl',['task'=>$task]); ?>

    <div class='col-lg-2 form-center btnTaskDone'>
        <?= Html::button('Cerrar',['class' => 'btn btn-danger btnModal','data-dismiss'=>'modal'])?>
    </div>