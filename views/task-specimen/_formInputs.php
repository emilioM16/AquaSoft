<?php
use kartik\touchspin\TouchSpin;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use kartik\alert\Alert;
?>
             
             <?php
            if(!empty($compatibleAquariums)){ //si hay acuarios compatibles
                foreach ($compatibleAquariums as $key => $aquarium) {
        
                    echo '<div class="form-group col-lg-3 form-center">
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
                echo '<div class="col-lg-12" align="center">
                        <div class="col-lg-6">'.Html::button(FA::icon("check")->size(FA::SIZE_LARGE).' Aceptar',['id'=>'addBtn','class'=>'btn btn-success']).'</div>
                        <div class="col-lg-6">'.Html::button(FA::icon("times")->size(FA::SIZE_LARGE).' Cancelar',['class'=>'btn btn-danger','data-dismiss'=>'modal']).'</div>
                    </div>';
                }else{ //si no hay acuarios compatibles 
                    echo '<div class="col-lg-9 form-center">'
                    .Alert::widget([
                        'type' => Alert::TYPE_DANGER,
                        'icon' => 'glyphicon glyphicon-remove-sign',
                        'body' => 'No existen acuarios aptos para la especie seleccionada.',
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