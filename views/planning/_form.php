<?php

use yii\helpers\Html;

use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Modal;
use yii\web\JsExpression;
use app\models\planning\Planning;
use app\models\aquarium\Aquarium;
use app\controllers\PlanningController;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model app\models\planning\Planning */

$this->title = 'Nueva planificacion';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planning-create">

  <?= Html::encode($this->title) ?>

  <div class="row">
  <div class="planning-form col-lg-12">
      <div class="col-lg-6 form-center">
                <div class="well text-center">

                  <?php
                  $form = ActiveForm::begin([
                   'action' => ['planning/save-planning'],
                      'id'=>$model->formName(),
                      'type'=>ActiveForm::TYPE_VERTICAL]);

                  echo Form::widget([
                      'model'=>$model,
                      'form'=>$form,
                      'columns'=>3,
                      'attributes'=>[
                          'titulo'=>[
                              'type'=>Form::INPUT_TEXT,
                              'options'=>[
                                  'placeholder'=>'Ingrese el nombre',
                                  'maxlength'=>true,
                              ]
                          ],
                          'anioMes'=>[
                              'type'=>Form::INPUT_WIDGET,
                              'widgetClass'=>'kartik\date\DatePicker',
                              'options'=>[

                              ],
                              'pluginOptions' => [
                                'format' => 'dd-M-yyyy',
                                'todayHighlight' => true
                              ]
                          ],
                          'ACUARIO_USUARIO_acuario_idAcuario'=>[
                              'type'=>Form::INPUT_WIDGET,
                              'widgetClass'=>'kartik\select2\Select2',
                              'options'=>['data'=>$aquariums],

                           ],
                           'actions'=>[
                               'type'=>Form::INPUT_RAW,
                               'value'=>'<div class="form-group" align="center">'.
                                   Html::submitButton(
                                       $model->isNewRecord ? 'Aceptar' : FA::icon('save')->size(FA::SIZE_LARGE).' Modificar',
                                       [
                                           'class' => $model->isNewRecord ? 'btn btn-success btnModal' : 'btn btn-primary btnModal'
                                       ])
                           ]


                      ]
                  ]);

                        ?>

                  </div>
                    <?php ActiveForm::end(); ?>
                  </div>

        </div>
    </div>
    </div>





</div>
