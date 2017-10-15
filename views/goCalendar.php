<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\planning\Planning */
/* @var $form ActiveForm */
?>
<div class="goCalendar">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'titulo') ?>
        <?= $form->field($model, 'anioMes') ?>
        <?= $form->field($model, 'ACUARIO_USUARIO_acuario_idAcuario') ?>
        <?= $form->field($model, 'fechaHoraCreacion') ?>
        <?= $form->field($model, 'activo') ?>
        <?= $form->field($model, 'ACUARIO_USUARIO_usuario_idUsuario') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- goCalendar -->
