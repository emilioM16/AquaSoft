<?php

use kartik\alert\AlertBlock;
use yii\bootstrap\Html;
use rmrevin\yii\fontawesome\FA;

echo AlertBlock::widget([
	'type' => AlertBlock::TYPE_ALERT,
    'useSessionFlash' => true,
    'delay'=>false,
]).
'<div class="col-lg-12" align="center">'.Html::button(FA::icon("times")->size(FA::SIZE_LARGE)." Cerrar",["class"=>"btn btn-danger","data-dismiss"=>"modal"]).'</div>';
?>