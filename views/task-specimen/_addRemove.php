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
?>

<div id="cont">

        <div class="row">

            <div  class="col-lg-12">

                <div class="form-group col-lg-6 form-center" align="center">
                <?php
                echo '<label class="control-label">Especies</label>';
                echo Select2::widget([
                    'id'=>'selectSpecie'.$taskType, 
                    'name' => 'selectSpecie',
                    'data' => ArrayHelper::map($species,'idEspecie','nombre'),
                    'options' => [
                        'placeholder' => 'Seleccione una especie ...',
                    ],

                ]);
                ?>
                </div>

                <div id="inputs" class="col-lg-12">
                    <div class="col-lg-12" align="center">
                        <div class="col-lg-12"><?= Html::button(FA::icon("times")->size(FA::SIZE_LARGE).' Cancelar',['class'=>'btn btn-danger','data-dismiss'=>'modal'])?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div id="alert" class='col-lg-9 form-center'>
            </div>
        </div>

</div>