<?php 
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
?>

<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 form-center">
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

<h5 class="text-center"><b>Insumos utilizados</b></h5>
<?php
    $insumos = $task->insumoTareas;
    if(!empty($insumos)){
?>
    <div class="row" align="center">
        <div class="col-lg-12 form-center">
            <table class="table table-striped table-bordered">
                <tr class="info">
                    <th>Nombre</th>
                    <th>Cantidad</th> 
                </tr>
                <?php

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
<?php }else{ ?>
    <h5 class="text-center">No se utilizaron insumos</h5>
<?php } ?>


<?php
    switch ($task->TIPO_TAREA_idTipoTarea) {
        case 'Controlar acuario':
            echo $this->render('_taskDoneControl',['conditions'=>$task->condicionAmbiental]);
        break;
        case 'Transferir ejemplares':
            echo $this->render('_taskDoneTransfer',['movements'=>$task->movimientos]);
        break;
        case 'Incorporar ejemplares':
            $movimiento = $task->movimientos[0];
            if($movimiento['cantidad']  == 1){
                echo '<br>
                <h4 class="text-center"><b>Se incorporó '.$movimiento['cantidad'].' ejemplar de la especie "'.$movimiento->ejemplar->especie["nombre"].'"</b></h4>';
            }else{
                echo '<br>
                <h4 class="text-center"><b>Se incorporaron '.$movimiento['cantidad'].' ejemplares de la especie "'.$movimiento->ejemplar->especie["nombre"].'"</b></h4>';          
            }    
        break;
        case 'Quitar ejemplares':
            $movimiento = $task->movimientos[0];
            if(abs($movimiento['cantidad']) == 1){
                echo '<br>
                <h4 class="text-center"><b>Se quitó '.abs($movimiento['cantidad']).' ejemplar de la especie "'.$movimiento->ejemplar->especie["nombre"].'"</b></h4>';    
            }else{
                echo '<br>
                <h4 class="text-center"><b>Se quitaron '.abs($movimiento['cantidad']).' ejemplares de la especie "'.$movimiento->ejemplar->especie["nombre"].'"</b></h4>';
            }
        break;
        default:
        break;
    }
 
?>

    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 form-center btnTaskDone'>
        <?= Html::button('Cerrar',['class' => 'btn btn-danger btnModal','data-dismiss'=>'modal'])?>
    </div>