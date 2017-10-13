<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\planning\Planning */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planning-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anioMes')->textInput() ?>

    <?= $form->field($model, 'fechaHoraCreacion')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <?= $form->field($model, 'ACUARIO_USUARIO_acuario_idAcuario')->textInput() ?>

    <?= $form->field($model, 'ACUARIO_USUARIO_usuario_idUsuario')->textInput() ?>

    <?= $form->field($model, 'ESTADO_PLANIFICACION_idEstadoPlanificacion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
