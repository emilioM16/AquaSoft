<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\task\TakSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idTarea') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'fechaHoraInicio') ?>

    <?= $form->field($model, 'fechaHoraFin') ?>

    <?php // echo $form->field($model, 'fechaHoraRealizacion') ?>

    <?php // echo $form->field($model, 'PLANIFICACION_idPlanificacion') ?>

    <?php // echo $form->field($model, 'USUARIO_idUsuario') ?>

    <?php // echo $form->field($model, 'ACUARIO_idAcuario') ?>

    <?php // echo $form->field($model, 'TIPO_TAREA_idTipoTarea') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
