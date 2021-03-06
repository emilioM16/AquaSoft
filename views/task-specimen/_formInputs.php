<?php
use kartik\touchspin\TouchSpin;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use kartik\alert\Alert;
?>
             
             <?php
            if(!empty($aquariums)){ //si hay acuarios compatibles
                echo '<div id="inputsWell" class="well col-lg-6 form-center">
                    <p id="wellTitle" class="text-center">Acuarios disponibles</p><hr class="divider">';
                foreach ($aquariums as $key => $aquarium) {
                    echo '<div class="form-group input col-lg-7 form-center">
                            <label class="text-center">'.$aquarium->nombre.'</label>'
                                .TouchSpin::widget([
                                    'id'=>$aquarium->idAcuario,
                                    'name' => $aquarium->nombre,
                                    'pluginOptions' => [
                                        'buttonup_class' => 'btn btn-primary', 
                                        'buttondown_class' => 'btn btn-danger', 
                                        'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>', 
                                        'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>',
                                        'initval'=>'0',
                                        'min'=>'0',
                                        'max'=>$aquarium->maxQuantity
                                    ],
                                    'options'=>[
                                        'class'=>'input-sm text-center tsInput',
                                        'readonly'=>true,      
                                    ]
                                ]).
                        '</div>';
                }
                echo '</div> 
                    <div class="col-lg-12" align="center">
                        <div class="col-lg-6">'.Html::button(FA::icon("check")->size(FA::SIZE_LARGE).' Aceptar',['id'=>$taskType.'Btn','class'=>'btn btn-success']).'</div>
                        <div class="col-lg-6">'.Html::button(FA::icon("times")->size(FA::SIZE_LARGE).' Cancelar',['class'=>'btn btn-danger','data-dismiss'=>'modal']).'</div>
                    </div>';
                }else{ //si no hay acuarios compatibles 
                    echo '<div class="col-lg-9 form-center">'
                    .Alert::widget([
                        'type' => Alert::TYPE_DANGER,
                        'icon' => 'glyphicon glyphicon-remove-sign',
                        'body' => 'No existen acuarios disponibles para la especie seleccionada.',
                        'showSeparator' => true,
                        'delay' => 0,
                        'closeButton'=>false,
                        'options'=>[
                            'class'=>'form-center',
                            'align'=>'center'
                        ]
                    ])
                    .'</div>';
                }            
            ?>  