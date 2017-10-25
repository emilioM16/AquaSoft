<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\planning\PlanningSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planning-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

     <?= $form->field($model, 'idPlanificacion') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'anioMes') ?>

    <?= $form->field($model, 'fechaHoraCreacion') ?>

    <?= $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'ACUARIO_USUARIO_acuario_idAcuario') ?>

    <?php // echo $form->field($model, 'ACUARIO_USUARIO_usuario_idUsuario') ?>

    <?php // echo $form->field($model, 'ESTADO_PLANIFICACION_idEstadoPlanificacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
