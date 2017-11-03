<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\specie\Specie */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="specie-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'minPH')->textInput() ?>

    <?= $form->field($model, 'maxPH')->textInput() ?>

    <?= $form->field($model, 'minTemp')->textInput() ?>

    <?= $form->field($model, 'maxTemp')->textInput() ?>

    <?= $form->field($model, 'minSalinidad')->textInput() ?>

    <?= $form->field($model, 'maxSalinidad')->textInput() ?>

    <?= $form->field($model, 'minLux')->textInput() ?>

    <?= $form->field($model, 'maxLux')->textInput() ?>

    <?= $form->field($model, 'minEspacio')->textInput() ?>

    <?= $form->field($model, 'minCO2')->textInput() ?>

    <?= $form->field($model, 'maxCO2')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
