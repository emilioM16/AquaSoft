<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\specie\Specie */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="specie-form">
  <div class="planning-form col-lg-10">
    <div class="col-lg-9 form-center">
              <div class="well text-left">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'minPH')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'maxPH')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'minTemp')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'maxTemp')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'minSalinidad')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'maxSalinidad')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'minLux')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'maxLux')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'minEspacio')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'minCO2')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'maxCO2')->textInput(['type' => 'number']) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Finalizar' : 'Volver al inicio', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
    </div>
      </div>

</div>
