<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\ActiveForm;
use kartik\touchspin\TouchSpin;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Acuario */
/* @var $form yii\widgets\ActiveForm */
if (isset($q)){
    print_r($q);
}
?>
<div id="cont">

    <!-- <?php $form = ActiveForm::begin(
        [

        ]
    ); ?> -->

        <div class="row">

            <div  class="col-lg-12">

                <div class="form-group col-lg-12" align="center">
                <?php
                echo '<label class="control-label">Especies</label>';
                echo Select2::widget([
                    'id'=>'selectSpecie',
                    'name' => 'selectSpecie',
                    'data' => ArrayHelper::map($species,'idEspecie','nombre'),
                    'options' => [
                        'placeholder' => 'Seleccione una especie ...',
                    ],

                ]);
                ?>
                </div>

                <div id="inputs" class="col-lg-12">
                </div>
 
                <div id="alert" class='col-lg-9'>
                </div>
            </div>
        </div>

    <!-- <?php ActiveForm::end(); ?> -->

</div>