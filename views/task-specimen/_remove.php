<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\ActiveForm;
use kartik\touchspin\TouchSpin;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Acuario */
/* @var $form yii\widgets\ActiveForm */
if (isset($q)){
    print_r($q);
}
?>
<div id="cont">

        <div class="row">

            <div  class="col-lg-12">

                <div class="form-group col-lg-4 form-center" align="center">
                <?php
                echo '<label class="control-label">Especies</label>';
                echo Select2::widget([
                    'id'=>'selectSpecieRemove',
                    'name' => 'selectSpecieRemove',
                    'data' => ArrayHelper::map($species,'idEspecie','nombre'),
                    'options' => [
                        'placeholder' => 'Seleccione una especie ...',
                    ],

                ]);
                ?>
                </div>

                <div id="inputsRemove" class="col-lg-12">
                </div>
            </div>
        </div>

        <div class="row">
            <div id="alertRemove" class='col-lg-9 form-center'>
            </div>
        </div>

</div>