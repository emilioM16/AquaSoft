<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Modal;
use yii\web\JsExpression;
use app\models\planning\Planning;
use app\models\aquarium\Aquarium;
use app\controllers\PlanningController;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\planning\Planning */

$this->title = 'Nueva planificacion';
$this->params['breadcrumbs'][] = ['label' => 'Plannings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planning-create">

  <?= Html::encode($this->title) ?>

  <div class="row">
  <div class="planning-form col-lg-12">
      <div class="col-lg-6 form-center">


            <?php $form = ActiveForm::begin([
                'layout'=>'inline',
                'id' =>'formulario',
                'method'=>'post',
                'enableClientValidation'=> false,
                'enableAjaxValidation'=> true,
                ]);
                ?>

                <div class="well text-center">

                    <div class="form-group">
                    <label>Titulo</label>
                    <input id="titulo" type="input" class="form-control"  style="width:200px" placeholder="Titulo planificacion">
                  </div><br><br>


                    <div class="form-group">
                        <label> Acuario </label>

                      <?= $form->field($model, 'ACUARIO_USUARIO_acuario_idAcuario')->dropDownList(
                            ArrayHelper::map(Aquarium::find()->all(),'idAcuario','nombre'),
                      ['prompt'=>'-']
                      )
                      ?>

                    </div><br> <br>


                    <div class="form-group">
                        <label for="exampleInputPassword1">     Mes/Año</label>
                        <input id="monthYearSelect" type="month" class="form-control" id="exampleInputPassword1" style="width:auto" placeholder="Título">
                    </div> <br> <br>


                    <div class="form-group">
                          <!-- Html::submitButton('Aceptar', ['id'=>'accept','class' => 'btn btn-primary'])
                          Html::button('Button Text', array('submit' => array('PlanningController/validoPrueba')));  -->

                          <?= Html::button(' Aceptar',['value' => Url::to(['planning/create']),
                                    ]) ?>

                    </div>












                  </div>
                    <?php ActiveForm::end(); ?>
                  </div>

        </div>
    </div>
    </div>

<!--


    <div id="pCalendar" class="row">
    <div class="col-lg-12">
        <div class="col-lg-6 form-center">
            <?= yii2fullcalendar\yii2fullcalendar::widget([
                'id'=>'calendar',
                'defaultView'=>'month',
                'header'=>[
                    'left'=>'',
                    'center'=>'title',
                    'right'=>'',
                ],
                'clientOptions'=>[
                    'selectable' => true,
                    'selectHelper' => true,
                    'editable' => false,
                    'fixedWeekCount'=>false,
                    'showNonCurrentDates'=>false,
                    // 'select' => new JsExpression($JSCode),
                    // 'eventClick' => new JsExpression($JSEventClick),
                    'defaultDate' => date('d-m-Y'),
                    'firstDay'=>1,
                ],
                'options' => [
                    'lang' => 'es',
                ],
                // 'events' => $events,
            ]);

            Modal::begin([
                'id'=>'pModal',
                'size'=>'modal-md',
                'closeButton'=>[],
                'footer'=>
                    Html::button(FA::icon('save')->size(FA::SIZE_LARGE).' Guardar', ['class' => 'btn btn-success']).
                    Html::button(FA::icon('remove')->size(FA::SIZE_LARGE).' Cancelar',['class' => 'btn btn-danger','data-dismiss'=>'modal'])

                ]);


            Modal::end();

            ?>
            <div id="pButtons" class="form-group">
                <?= Html::button(FA::icon('save')->size(FA::SIZE_LARGE).' Guardar', ['class' => 'btn btn-success']) ?>
                <?= Html::a(FA::icon('remove')->size(FA::SIZE_LARGE).' Cancelar', ['index'] ,['class' => 'btn btn-danger']) ?>
            </div>
        </div>
    </div>
    </div> -->



</div>
