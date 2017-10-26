<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\task\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">
    <?php 
    $taskId =-1;

    if ($model->idTarea!==null){
        $taskId = $model->idTarea;
    }

    $form = ActiveForm::begin([
        'id'=>$model->formName(),
        'enableAjaxValidation'=>true, //importante, valida si el nombre ya está en uso
        'validationUrl'=> Url::toRoute(['task/validation','id'=>$taskId]), 
        'type'=>ActiveForm::TYPE_VERTICAL]);





    ActiveForm::end();
    ?>

</div>
