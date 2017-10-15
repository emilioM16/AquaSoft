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

                // echo $form->field($model, 'EJEMPLAR_especie_idEspecie')->widget(Select2::classname(), [
                //     'id'=>'selectSpecie',
                //     'data' => ArrayHelper::map($species, 'idEspecie', 'nombre'),
                //     'options'=>[
                //         'placeholder'=>'Seleccione una especie...',
                //     ]
                // ]);
                //         yii::error(\yii\helpers\VarDumper::dumpAsString());
                // echo $form->field($model, 'EJEMPLAR_acuario_idAcuario')->widget(DepDrop::classname(), [
                //     'type'=>DepDrop::TYPE_SELECT2,
                //     // 'options'=>['id'=>'selectAquarium'],
                //     'pluginOptions'=>[
                //         'depends'=>['selectSpecie'],
                //         'placeholder'=>'Seleccione un acuario...',
                //         'url'=>Url::to(['/task-specimen/select-aquarium'])
                //     ]
                // ]);
                ?>
                </div>

                <div id="inputs">
                </div>
 

            </div>
        </div>

    <!-- <?php ActiveForm::end(); ?> -->

</div>