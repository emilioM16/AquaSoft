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
use app\models\aquarium\Aquarium;
use app\models\user\User;
use app\models\planning\Validation;
use yii\web\session;


/* @var $this yii\web\View */
/* @var $model app\models\Acuario */

$this->title = $model->titulo;
//$this->params['breadcrumbs'][] = ['label' => 'Planificacion', 'url' => ['index']];

//$this->params['breadcrumbs'][] = $this->title;


?>

<div id="jumboIdAcuario" class="jumbotron">
  <h2 id="tituloJumboAcuario"><?= $model->titulo ?></h2>
</div>

<div class="planning-calendar">


<div class="row content">
  <div class="col-lg-12">


<?php

$session = Yii::$app->session;
$puedeAdminPlan = Yii::$app->user->can('administrarPlanificaciones');
$estaCreandoActualizando = (($session->get('var') == 'create') || ($session->get('var') == 'update'));

if($estaCreandoActualizando && $puedeAdminPlan){
// Evento que se ejecuta al presionar sobre una tarea
$JSEventClick = <<<EOF
function(calEvent, jsEvent, view) {
    // var fechaActualSinHora = new Date().getFullYear() + '-' + (new Date().getMonth() + 1) + '-' + new Date().getDate();
    // if (new Date(calEvent.end.format())>= new Date(fechaActualSinHora)){
        $.ajax({
          type: 'GET',
          url: "/task/update", 
          data: {idTarea:calEvent.id} ,
          dataType: 'html',
          error: function(xhr,err){
            alert("readyState: "+xhr.readyState+" status: "+xhr.status);
        },
          success: function(response){
              $('#modalContent').html(response);
              $('#modalTitle').html('Modificar tarea');
              $('#modal').modal('show');
              }
          });
    // } else
    // alert('No se pueden editar tareas de fechas pasadas');
}
EOF;
}else{
$JSEventClick = <<<EOF
function(calEvent, jsEvent, view) {
    $.ajax({
      type: 'GET',
      url: "/task/view", 
      data: {idTarea:calEvent.id} ,
      dataType: 'html',
      error: function(xhr,err){
        alert("readyState: "+xhr.readyState+" status: "+xhr.status);
        alert("responseText: "+xhr.responseText);
    },
      success: function(response){
          $('#modalContent').html(response);
          $('#modalTitle').html('Visualizar tarea');
          $('#modal').modal('show');
          }
      });
}
EOF;
}

if ($estaCreandoActualizando && $puedeAdminPlan){
// Evento que se ejecuta al presionar sobre un día del calendario
$JSDayClick = <<<EOF
function(date, jsEvent, view) {
    var fechaActualSinHora = new Date().getFullYear() + '-' + (new Date().getMonth() + 1) + '-' + new Date().getDate();
    if (new Date(date.format())>= new Date(fechaActualSinHora)){
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
    }else
    alert('No se pueden crear tareas en fechas pasadas');
}
EOF;
}else{
$JSDayClick = <<<EOF
function(date, jsEvent, view) {}
EOF;
}

?>
<div class="planning-check">


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
    <div class="col-lg-3" style="position:absolute;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

      <body>
      <div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="info">
                <?php echo '<div class="text-center" style="font-size:16px;">Información</div>'; ?>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                  <?php echo'<b>'.'Fecha: '.'</b>'. date_format(date_create($model->anioMes),"m / Y");?>
              </td>
            </tr>
            <tr>
              <td>
                  <?php echo '<b>'.'Fecha creación: '.'</b>'.date_format(date_create($model->fechaHoraCreacion),"d / m / Y"); ?>
              </td>
            </tr>
            <tr>
              <td>
                  <?php
                  $acua = Aquarium::find()->where(['idAcuario' => $model->ACUARIO_USUARIO_acuario_idAcuario])->one();
                   echo '<b>'.'Acuario: '.'</b>'.$acua->nombre;
                   ?>
              </td>
            </tr>
            <tr>
              <td>
                  <?php echo '<b>'.'Estado: '.'</b>'.$model->ESTADO_PLANIFICACION_idEstadoPlanificacion; ?>
              </td>
            </tr>
            <tr>
                <?php
                  $vali = Validation::find()->where(['PLANIFICACION_idPlanificacion' => $model->idPlanificacion])->one();
                  if ($model->ESTADO_PLANIFICACION_idEstadoPlanificacion =='Rechazada') {
                  echo '<td><b>'.'Motivo rechazo: '.'</b>'.$vali->MOTIVO_RECHAZO_idMotivoRechazo;
                  echo
                  '</td>'.
            '</tr>'.

            '<tr>'.
              '<td>'.
                '<b>'.'Observación: '.'</b>'.$vali->OBSERVACION;
                '</td>'.
            '</tr>';
            $us = User::find()->where(['idUsuario' => $vali->USUARIO_idUsuario])->one();
            echo
            '<tr>'.
              '<td>'.
                '<b>'.'Encargado: '.'</b>'.$us->nombre;
              '</td>'.
            '</tr>';
            echo
            '<tr>'.
              '<td>'.
                '<b>'.'Fecha hora autorización: '.'</b>'.date_format(date_create($vali->FECHAHORA),"d / m / Y h:m").' hs';
              '</td>'.
            '</tr>';

                  }
                ?>
          </tbody>
        </table>
      </div>

          <?php

          if ($session->get('var')=='check'){
          echo '<div><br>'
            .Html::a(FA::icon("calendar-check-o")->size(FA::SIZE_LARGE).' Autorizar', ['planning/autorized', 'id' => $model->idPlanificacion], [
                      'class' => 'btn btn-success',
                      'data' => [
                          'confirm' => '¿Esta seguro que desea autorizar esta planificacion?',
                          'method' => 'post',
                        ],
                      ]).'  '.

            Html::button(FA::icon("times")->size(FA::SIZE_LARGE).' Rechazar',
                          [
                           'value' => Url::to(['refuse','id'=>$model->idPlanificacion]),
                            'title' => 'Rechazar planificación ',
                            'class' => 'showModalButton btn btn-danger'
                          ])
            .'</div>';
            echo '<div><br>'
              .Html::a(FA::icon("arrow-left")->size(FA::SIZE_LARGE).' Atras', ['planning/index'], [
                        'class' => 'btn btn-primary',
                        'data' => [
                            //'confirm' => '¿Esta seguro que desea autorizar esta planificacion?',
                            'method' => 'post',
                          ],
                        ])
              .'</div>';
          }
           elseif($session->get('var')=='view'){
             echo '<div><br>'
               .Html::a(FA::icon("arrow-left")->size(FA::SIZE_LARGE).' Atras', ['planning/index'], [
                         'class' => 'btn btn-primary',
                         'data' => [
                             //'confirm' => '¿Esta seguro que desea autorizar esta planificacion?',
                             'method' => 'post',
                           ],
                         ])
               .'</div>';
                }
                else{
                  echo '<div><br>'
                  .Html::a('Finalizar', ['planning/home', 'id' => $model->idPlanificacion], [
                        'class' => 'btn btn-success',
                        'data' => [
                          //  'confirm' => '¿Esta seguro que desea autorizar esta planificacion?',
                          //  'method' => 'post',
                          ],
                        ]).
                  '</div>';
                }


              ?>


    </body>

    </div>


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
                'fixedWeekCount'=>false, 
                'showNonCurrentDates'=>false, 
                'eventLimit' => true,
                'fixedWeekCount' => false,
                'dayClick'=>new \yii\web\JsExpression($JSDayClick),
                'eventClick'=>new \yii\web\JsExpression($JSEventClick),
                'firstDay'=>1,
                'eventStartEditable'=>false,
            ],
        ]);
        ?>
      </div>




    </div>
  </div>
<!-- //////////////////////////////////////////////////////////////////////////////////////// -->

        <br>


  <?php
