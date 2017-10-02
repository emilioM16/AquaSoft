<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\models\Acuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acuario-form">

    <?php $form = ActiveForm::begin([
        'id' => $model->formName(),
        'enableAjaxValidation'=>true,
        'validationUrl'=> Url::toRoute('aquarium/validation'),
    ]); ?>
    
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'descripcion')->textarea(['maxlength' => true, 'rows'=>'4']) ?>

    <?= $form->field($model, 'espaciodisponible')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <div class="form-group" align="center">
        <?= Html::submitButton($model->isNewRecord ? FA::icon('save')->size(FA::SIZE_LARGE).' Agregar' : FA::icon('save')->size(FA::SIZE_LARGE).' Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::button(FA::icon('remove')->size(FA::SIZE_LARGE).' Cancelar',['class' => 'btn btn-danger','data-dismiss'=>'modal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
