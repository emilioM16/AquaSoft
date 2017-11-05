<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\supply\Supply */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supply-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stock')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'TIPO_TAREA_idTipoTarea')->dropDownList(['Alimentación' => 'Alimentación', 'Controlar acuario' => 'Controlar acuario', 'Incorporar ejemplares' => 'Incorporar ejemplares', 'Limpieza' => 'Limpieza','Reparación' => 'Reparación','Transferir ejemplares' => 'Transferir ejemplares']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear ' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
