<?php

use kartik\alert\AlertBlock;

echo AlertBlock::widget([
	'type' => AlertBlock::TYPE_ALERT,
    'useSessionFlash' => true,
    'delay'=>false,
]);

?>