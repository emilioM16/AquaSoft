<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;

$this->title = 'Sistema gestión AquaSoft';
?>
<div class="site-index">

    <div class="body-content">

      <div class="row">
        <div class="col-lg-12">
          <?= Html::img('@web/img/logo.png', ['class'=>'img-center img-responsive col-lg-4 col-md-4 col-sm-4 col-xs-2 form-center',]); ?>
        </div>
      </div>

      <div class="panel panel-info panel-login col-lg-3 col-md-2 col-sm-4 col-xs-2 form-center">
        <div class="panel-heading text-center">
          Iniciar sesión
        </div>
        <div class="form-center panel-body">
          <div class="row">
              <div class="col-lg-12">
                <?php

                  $form = ActiveForm::begin([
                    'id' => 'formulario-login',

                    'fieldConfig' => [
                      //  'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
                      //  'labelOptions' => ['class' => 'col-lg-3 control-label'],
                      ]
                  ]);?>
                <div class="col-lg-12 form-center">
                  <?= $form->field($model, 'username',[
                    'inputTemplate'=>'<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>{input}</div>'
                  ])->textInput(['autofocus'=>true]); ?>
                  <?= $form->field($model, 'password',[
                    'inputTemplate'=>'<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>{input}</div>'
                  ])->passwordInput([]); ?>
                </div>
              </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
                    <div class="form-group">
                      <div class="col-lg-12 form-center">
                        <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary', 'id' => 'boton-login']) ?>
                      </div>
                    </div>
          </div>
        </div>

                <?php ActiveForm::end(); ?>


        </div>
      </div>
    </div>
  </div>
</div>
