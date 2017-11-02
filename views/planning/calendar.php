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
use app\models\planning;
use yii\web\session;


/* @var $this yii\web\View */
/* @var $model app\models\Acuario */

//$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Planificacion', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;


?>
<div class="planning-calendar">


<div class="row content">
  <div class="col-lg-12">

<script type="text/javascript">
var idAcua = "<?php echo $model->ACUARIO_USUARIO_acuario_idAcuario; ?>";
var idPlan = "<?php echo $model->idPlanificacion ; ?>";


</script>

<?php

$JSDayClick = <<<EOF
function(date, jsEvent, view) {
  $.ajax({
    type: 'GET',
    url: "/task/create",
    data: 'idAcuario='+{$model->ACUARIO_USUARIO_acuario_idAcuario}
          +'&idPlanificacion='+{$model->idPlanificacion}
          +'&fechaInicio='+date.format(),
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

}
EOF;
?>
<div class="planning-check">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'titulo',
            [
            'attribute'=>'fechaHoraCreacion',
            'format' => ['date','php:d-m-Y'] // dar formato hora
            ],
            //[
            //'ACUARIO_USUARIO_acuario_idAcuario',
            //'aCUARIOUSUARIOAcuarioIdAcuario.nombre',
            //agregar nombre acuario
          //  ],
            [
              'attribute'=>'ESTADO_PLANIFICACION_idEstadoPlanificacion',
              'value'=>'vALIDACIONs.OBSERVACION'
            ],


          ]

    ]);

    ?>
    </div>

<script type="text/javascript"> //Este es el código que permite que se muestre el calendario seteandole la fecha//
    window.onload = function(){
    var monthYear = '<?php echo $model->anioMes ?>';
    var date = new Date(monthYear);
    var month = date.getMonth()+1;
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
            'events' => $model->events,
            'clientOptions' => [

                'language' => 'fa',
                'eventLimit' => TRUE,
                'fixedWeekCount' => false,
                 //'dayClick'=>new \yii\web\JsExpression($JSEventClick),
                //  'select' => new JsExpression($JSCode),
                 'dayClick'=>new \yii\web\JsExpression($JSDayClick),
              //  'eventClick'=>new \yii\web\JsExpression($JSEventClick),

            ],
        ]);
        ?>
      </div>
    </div>
  </div>
<!-- //////////////////////////////////////////////////////////////////////////////////////// -->

        <br>
        <?php
        $session = Yii::$app->session;

        if ($session->get('var')=='check'){
        echo '<div>'
          .Html::a('Autorizar', ['planning/autorized', 'id' => $model->idPlanificacion], [
                    'class' => 'btn btn-success',
                    'data' => [
                        'confirm' => '¿Esta seguro que desea autorizar esta planificacion?',
                        'method' => 'post',
                      ],
                    ]).'  '.

          Html::button('<span class="glyphicon glyphicon-remove"></span>',
                        [
                         'value' => Url::to(['refuse','id'=>$model->idPlanificacion]),
                          'title' => 'Rechazar planificacion ',
                          'class' => 'showModalButton btn btn-danger'
                        ])
          .'</div>';
        }

          elseif($session->get('var')=='update'){
            echo '<div>'
            .Html::a('Finalizar', ['planning/home', 'id' => $model->idPlanificacion], [
                  'class' => 'btn btn-success',
                  'data' => [
                    //  'confirm' => '¿Esta seguro que desea autorizar esta planificacion?',
                    //  'method' => 'post',
                    ],
                  ]).
            '</div>';
          }

         elseif($session->get('var')=='view'){
            echo '<div>'
           .Html::a('Volver al inicio', ['planning/index'], [
                    'class' => 'btn btn-primary',
                    'data' => [
                    //    'confirm' => '¿Esta seguro que desea autorizar esta planificacion?',
                        'method' => 'post',
                      ],
                ]).
              '</div>';
              }
            ?>


  <?php

//  if(Yii::$app->user->can('administrarTareas')){

//    echo '<div>'
//      .Html::button(FA::icon('check')->size(FA::SIZE_LARGE).' Rechazar',
//                [
//                   'value' => Url::to([
//                      'planning/autorized',
//                      'idPlanificacion'=>$model->idPlanificacion,
//                      // 'idPlanificacion'=>-1, // esto significa que es no planificada
//                      // 'fecha'=>date("Y-m-d") // hoy
//                    ]),
//                  'title' => 'Agregar tarea no planificada',
//                  'class' => 'btn btn-danger'
//                ]).
//    '</div>';

//    echo '<div>'
//      .Html::button(FA::icon('check')->size(FA::SIZE_LARGE).' Finalizar',
//                [
//                   'value' => Url::to([
//                      'planning/index',
//                      'idPlanificacion'=>$model->idPlanificacion,
//                      // 'idPlanificacion'=>-1, // esto significa que es no planificada
//                      // 'fecha'=>date("Y-m-d") // hoy
//                    ]),
//                  'title' => 'Agregar tarea no planificada',
//                  'class' => 'btn btn-primary'
//                ]).
//    '</div>';

//    echo '<div>'
//      .Html::button(FA::icon('home')->size(FA::SIZE_LARGE).' Volver al inicio',
//                [
//                   'value' => Url::to([
//                      'planning/index',
//                      'idPlanificacion'=>$model->idPlanificacion,
                      // 'idPlanificacion'=>-1, // esto significa que es no planificada
                      // 'fecha'=>date("Y-m-d") // hoy
//                    ]),
//                  'title' => 'Agregar tarea no planificada',
//                  'class' => 'btn btn-primary'
//                ]).
//    '</div>';
  //}


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
