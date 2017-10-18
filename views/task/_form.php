<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\task\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fechaHoraInicio')->textInput() ?>

    <?= $form->field($model, 'fechaHoraFin')->textInput() ?>

    <?= $form->field($model, 'fechaHoraRealizacion')->textInput() ?>

    <?= $form->field($model, 'PLANIFICACION_idPlanificacion')->textInput() ?>

    <?= $form->field($model, 'USUARIO_idUsuario')->textInput() ?>

    <?= $form->field($model, 'ACUARIO_idAcuario')->textInput() ?>

    <?= $form->field($model, 'TIPO_TAREA_idTipoTarea')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
