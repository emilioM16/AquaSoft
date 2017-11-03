<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\specie\SpecieSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="specie-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idEspecie') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'minPH') ?>

    <?= $form->field($model, 'maxPH') ?>

    <?php // echo $form->field($model, 'minTemp') ?>

    <?php // echo $form->field($model, 'maxTemp') ?>

    <?php // echo $form->field($model, 'minSalinidad') ?>

    <?php // echo $form->field($model, 'maxSalinidad') ?>

    <?php // echo $form->field($model, 'minLux') ?>

    <?php // echo $form->field($model, 'maxLux') ?>

    <?php // echo $form->field($model, 'minEspacio') ?>

    <?php // echo $form->field($model, 'minCO2') ?>

    <?php // echo $form->field($model, 'maxCO2') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
