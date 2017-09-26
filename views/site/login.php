<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Sistema gestión AquaSoft';
?>
<div class="site-index">

    <div class="body-content">

      <div class="row">
        <div>
          <?= Html::img('@web/img/logo.png', ['class'=>'img-center img-responsive']); ?>
        </div>
      </div>

      <div class="panel panel-info panel-login col-lg-3 form-center">
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
                  <?= $form->field($model, 'username')->textInput(['autofocus'=>true,]); ?>
                  <?= $form->field($model, 'password')->passwordInput([]); ?>
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
