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

<!-- la idea de esto es mostrar todos los insumos asociados al tipo de tarea. A esta lista la obtendría de $model->tipoTarea->insumos -->

<div class="supply">
    <?php 
    // $form = ActiveForm::begin(
    //     [
    //     'id'=>$model->formName(),
    //     'enableAjaxValidation'=>true, //importante, valida si el nombre ya está en uso
    //     'validationUrl'=> Url::toRoute(['supply/validation','id'=>$taskId]), 
    //     'type'=>ActiveForm::TYPE_VERTICAL]
    // );

    // ActiveForm::end();
    ?>

</div>
