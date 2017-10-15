<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\ActiveForm;
use kartik\touchspin\TouchSpin;

/* @var $this yii\web\View */
/* @var $model app\models\Acuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planification-form">

    <?php $form = ActiveForm::begin(
        [

        ]
    ); ?>

        <div class="row">

            <div class="col-lg-12">

                <div class="form-group col-lg-12" align="center">
                    <label> Especie </label>
                    <select  class="form-control" style="width:auto">
                        <option selected> </option>
                        <option>Aulonocaras</option>
                        <option>Laberíntidos</option>
                        <option>Kuhli</option>
                        <option>Guppy</option>
                        <option>Barbo</option>
                    </select>
                </div>

                <div class="form-group col-lg-12" align="center">
                    <label> Acuario de origen </label>
                    <select  class="form-control" style="width:auto">
                        <option selected> </option>
                        <option>AS01</option>
                        <option>AD03</option>
                        <option>AD12</option>
                    </select>
                </div>

                <div class="well col-lg-12">

                    <p id="wellTitle" class="text-center">Acuarios con espacio disponible</p>

                    <div class="form-group col-lg-3">
                        <label class="text-center"> AS01 </label>

                        <?php 
                            echo TouchSpin::widget([
                                'name' => 't4',
                                'pluginOptions' => [
                                    'buttonup_class' => 'btn btn-primary', 
                                    'buttondown_class' => 'btn btn-danger', 
                                    'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>', 
                                    'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
                                ],
                                'options'=>[
                                    'class'=>'input-sm',
                                    'readonly'=>true
                                ]
                            ]);
                        ?>
                    </div>

                    <div class="form-group col-lg-3">
                        <label class="text-center"> AS05 </label>

                        <?php 
                            echo TouchSpin::widget([
                                'name' => 't4',
                                'pluginOptions' => [
                                    'buttonup_class' => 'btn btn-primary', 
                                    'buttondown_class' => 'btn btn-danger', 
                                    'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>', 
                                    'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
                                ],
                                'options'=>[
                                    'class'=>'input-sm',
                                    'readonly'=>true
                                ]
                            ]);
                        ?>
                    </div>
            
                    <div class="form-group col-lg-3">
                        <label class="text-center"> AS11 </label>

                        <?php 
                            echo TouchSpin::widget([
                                'name' => 't4',
                                'pluginOptions' => [
                                    'buttonup_class' => 'btn btn-primary', 
                                    'buttondown_class' => 'btn btn-danger', 
                                    'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>', 
                                    'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
                                ],
                                'options'=>[
                                    'class'=>'input-sm',
                                    'readonly'=>true
                                ]
                            ]);
                        ?>
                    </div>

                    <div class="form-group col-lg-3">
                        <label class="text-center"> AS12 </label>

                        <?php 
                            echo TouchSpin::widget([
                                'name' => 't4',
                                'pluginOptions' => [
                                    'buttonup_class' => 'btn btn-primary', 
                                    'buttondown_class' => 'btn btn-danger', 
                                    'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>', 
                                    'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
                                ],
                                'options'=>[
                                    'class'=>'input-sm',
                                    'readonly'=>true
                                ]
                            ]);
                        ?>
                    </div>

                    <div class="form-group col-lg-3">
                        <label class="text-center"> AS12 </label>

                        <?php 
                            echo TouchSpin::widget([
                                'name' => 't4',
                                'pluginOptions' => [
                                    'buttonup_class' => 'btn btn-primary', 
                                    'buttondown_class' => 'btn btn-danger', 
                                    'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>', 
                                    'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
                                ],
                                'options'=>[
                                    'class'=>'input-sm',
                                    'readonly'=>true
                                ]
                            ]);
                        ?>
                    </div>

                    <div class="form-group col-lg-3">
                        <label class="text-center"> AS12 </label>

                        <?php 
                            echo TouchSpin::widget([
                                'name' => 't4',
                                'pluginOptions' => [
                                    'buttonup_class' => 'btn btn-primary', 
                                    'buttondown_class' => 'btn btn-danger', 
                                    'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>', 
                                    'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
                                ],
                                'options'=>[
                                    'class'=>'input-sm',
                                    'readonly'=>true
                                ]
                            ]);
                        ?>
                    </div>
                </div>


                <div class="col-lg-12" align="center">
                    <div class="col-lg-6"><?= Html::button(FA::icon('check')->size(FA::SIZE_LARGE).' Aceptar',['class'=>'btn btn-success']);?></div>
                    <div class="col-lg-6"><?= Html::button(FA::icon('times')->size(FA::SIZE_LARGE).' Cancelar',['class'=>'btn btn-danger']);?></div>
                </div>

            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>