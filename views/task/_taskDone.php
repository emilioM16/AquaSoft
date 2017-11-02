<?php 
use yii\helpers\Html;
?>


<div class="row">
    <div class="col-lg-5 form-center">
        <?= Html::img('@web/img/clipboard.svg',['class'=>' img-responsive'])?>
    </div>
    <div class='col-lg-8 form-center'>
    <p id='taskDoneText' align="center">¡Esta tarea ya fue realizada!</p>
    </div>
    <div class='col-lg-2 form-center btnTaskDone'>
        <?= Html::button('Cerrar',['class' => 'btn btn-danger btnModal','data-dismiss'=>'modal'])?>
    </div>
</div>