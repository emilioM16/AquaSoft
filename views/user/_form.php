<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre_usuario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->input('email') ?> 

    <?= $form->field($model, 'contrasenia')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contrasenia_repeat')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activo')->inline()->radioList([1=>'Si',0=>'No'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Aceptar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>