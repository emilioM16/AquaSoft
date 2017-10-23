<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use derekisbusy\panel\PanelWidget;
use yii\bootstrap\Modal;
use kartik\tabs\TabsX;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Acuario */


$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Planificacion nueva', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="planning-calendar">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $model->idPlanificacion ?><br>


<div class="row content">
  <div class="col-lg-12">



<?php

$JSEventClick = <<<EOF
function(calEvent, jsEvent, view) {
  alert(calEvent);
  $.ajax({
    type: 'POST',
    url: "/task/create",
    data: idTarea= + calEvent.id,
    dataType: 'html',
    error: function(xhr){
        alert("Ha ocurrido un error. [: " + xhr.status + "] Detalle: " + xhr.statusText);
        alert("responseText: "+xhr.responseText);
        },
    success: function(response){
        $('#modalContent').html(response);
        $('#modalTitle').html('Registrar tarea');
        // $('#modalHeader').html('Registrar tarea');
        $('#modal').modal('show');
        }
    });
  // change the border color just for fun
  $(this).css('border-color', 'red');
}
EOF;
$JSCode = <<<EOF
    function(start, end) {
    var date = $('#calendar').fullCalendar('getDate');
    alert(start);

    }
EOF;
?>

<script type="text/javascript"> //Este es el código que permite que se muestre el calendario seteandole la fecha//
    window.onload = function(){
    var monthYear = <?php echo json_encode($model->anioMes) ?>
    var date = new Date(monthYear);
    var month = date.getMonth();
    var year = date.getFullYear();
    $('#calendar').fullCalendar('gotoDate', new Date(year,month));
    };
</script>


  <!-- Calendario -->
  <div id="pCalendar" class="row">
  <div class="col-lg-12">
      <div class="col-lg-6 form-center">



        <?= yii2fullcalendar\yii2fullcalendar::widget([
            'id'=>'calendar',
            'defaultView'=>'month',
            'header'=>[
                'left'=>'',
                'center'=>'title',
                'right'=>''
            ],
            'options' => [
                'lang' => 'es',
            ],
        //    'events' => $acuario->events,
            'clientOptions' => [

                'language' => 'fa',
                'eventLimit' => TRUE,
                'fixedWeekCount' => false,
                 //'dayClick'=>new \yii\web\JsExpression($JSEventClick),
                //  'select' => new JsExpression($JSCode),
                 'dayClick'=>new \yii\web\JsExpression($JSEventClick),
                'eventClick'=>new \yii\web\JsExpression($JSEventClick),

            ],
        ]);
        ?>
      </div>
    </div>
  </div>

</div>

  <?php


//  yii::error(\yii\helpers\VarDumper::dumpAsString(calEvent.id));

  // if(Yii::$app->user->can('administrarTareas')){
  //   echo '<div id="btnDetail" class="col-lg-2">'
  //     .Html::button(FA::icon('plus')->size(FA::SIZE_LARGE).' Agregar tarea no planificada',
  //               [
  //                  'value' => Url::to([
  //                     'task/create',
  //                   //  'idAcuario'=>$acuario->idAcuario,
  //                     // 'idPlanificacion'=>-1, // esto significa que es no planificada
  //                     // 'fecha'=>date("Y-m-d") // hoy
  //                   ]),
  //                 'title' => 'Agregar tarea no planificada',
  //                 'class' => 'showModalButton btn btn-success'
  //               ]).
  //   '</div>';
  // }
