<?php
use kartik\touchspin\TouchSpin;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
?>
             
             <?php
                foreach ($compatibleAquariums as $key => $aquarium) {
        
                    echo '<div class="form-group col-lg-3 form-center">
                            <label class="text-center">'.$aquarium->nombre.'</label>'
                                .TouchSpin::widget([
                                    'name' => 'touchspinAquarium',
                                    'pluginOptions' => [
                                        'buttonup_class' => 'btn btn-primary', 
                                        'buttondown_class' => 'btn btn-danger', 
                                        'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>', 
                                        'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>',
                                        'initval'=>'0',
                                    ],
                                    'options'=>[
                                        'class'=>'input-sm text-center ',
                                        'readonly'=>true,
                                        
                                    ]
                                ]).
                        '</div>';
                }
                echo '<div class="col-lg-12" align="center">
                        <div class="col-lg-6">'.Html::button(FA::icon("check")->size(FA::SIZE_LARGE).' Aceptar',["class"=>"btn btn-success"]).'</div>
                        <div class="col-lg-6">'.Html::button(FA::icon("times")->size(FA::SIZE_LARGE).' Cancelar',['class'=>'btn btn-danger']).'</div>
                    </div>'            
            ?>  