<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use derekisbusy\panel\PanelWidget;
use yii\bootstrap\Modal;
use kartik\tabs\TabsX;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Acuario */

$this->title = $acuario->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Acuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

    Modal::begin([
        'id'=>'pModal', 
        'size'=>'modal-md',
        'closeButton'=>[],
        'header'=> Yii::$app->session->get('modalTitle'),
        'headerOptions'=> ['class'=>'h3 text-center'],
        ]);
    
        echo '<div class="contenidoModal"></div>';
        
    Modal::end();

?>

<div id="jumboIdAcuario" class="jumbotron">
  <h2 id="tituloJumboAcuario">Acuario <?= $acuario->nombre ?></h2>
</div>

<div class="row content">
  <div class="col-lg-12">


    <!-- Panel de información -->
    <div class="col-lg-4">
    <?php
      $content1 =
      
      '<div class="col-lg-12">  

          <label>Nombre del acuario: </label> <span>'.$acuario->nombre.'</span>
          <br><br>

          <p class="text-justify">       
            <label>Descripción:</label>'
              .$acuario->descripcion.
          '</p>
          <br>

          <label>Espacio disponible: </label> <span>'.$acuario->espacioDisponible.'</span>
          <br><br>
          
      </div>' ;
 


        $items = [
          [
              'label'=>'<i class="glyphicon glyphicon-home"></i> Home',
              'content'=>$content1,
              //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/acuarium/tab'])],
              'active'=>true
          ],
          [
              'label'=>'<i class="glyphicon glyphicon-user"></i> Condiciones ambientales',
              'content'=>''
          ],
          [
            'label'=>'<i class="glyphicon glyphicon-user"></i> Población',
            'content'=>''
          ],
        ];


        echo TabsX::widget([
        'items'=>$items,
        'position'=>TabsX::POS_ABOVE,
        'encodeLabels'=>false,
        'bordered'=>true,
          ]);
    ?>    
    </div>

<?php
    $JSEventClick = <<<EOF
    function(calEvent, jsEvent, view) {
      $.ajax({
        type: 'POST',
        url: "/task/execute", 
        data: 'idTarea=' + calEvent.id,
        dataType: 'html',
        error: function(xhr){
            alert("Ha ocurrido un error. [: " + xhr.status + "] Detalle: " + xhr.statusText);
            },
        success: function(response){
            $('#modalContent').html(response);
            $('#modalHeader').html('<h2 class="modalTitle">Registrar tarea</h2>');
            $('#xModal').modal('show');
            }
        });
      // change the border color just for fun
      $(this).css('border-color', 'red');
    }
EOF;

Modal::begin([
    'id'=>'xModal', 
    'size'=>'modal-md',
    'headerOptions' => ['id' => 'modalHeader'],
    'closeButton'=>[],
    'footer'=>
        Html::button(FA::icon('save')->size(FA::SIZE_LARGE).' Guardar', ['class' => 'btn btn-success']).
        Html::button(FA::icon('remove')->size(FA::SIZE_LARGE).' Cancelar',['class' => 'btn btn-danger','data-dismiss'=>'modal'])
    
    ]);
    echo '<div id="modalContent"></div>';
Modal::end();
?>

<div id=modal></div>

  <!-- Calendario -->
  <div class="col-lg-6">
      <div class="row">
        <div id="pieChart" class="col-lg-12" align="center">
        <?= yii2fullcalendar\yii2fullcalendar::widget([
            'id'=>'calendar',
            'defaultView'=>'basicDay',
            'header'=>[
                'left'=>'prev,next today',
                'center'=>'title',
                'right'=>'basicDay,agendaWeek,month'
            ],
            'options' => [
                'lang' => 'es',
            ],
            'events' => $acuario->events,
            'clientOptions' => [
                'language' => 'fa',
                'eventLimit' => TRUE,
                'fixedWeekCount' => false,
                // 'dayClick'=>new \yii\web\JsExpression('function () {console.log("hola");}') Esto es para capturar el click sobre el día
                'eventClick'=>new \yii\web\JsExpression($JSEventClick)
            ],
        ]);
        ?>
      </div>
    </div>
  </div>

  <?php 
  if(Yii::$app->user->can('administrarTareas')){
    echo '<div id="btnDetail" class="col-lg-2">'
      .Html::button(FA::icon('plus')->size(FA::SIZE_LARGE).' Agregar tarea no planificada', 
                [
                   'value' => Url::to([
                      'task/create',
                      'idAcuario'=>$acuario->idAcuario,
                      // 'idPlanificacion'=>-1, // esto significa que es no planificada
                      // 'fecha'=>date("Y-m-d") // hoy
                    ]), 
                  'title' => 'Agregar tarea no planificada', 
                  'class' => 'showModalButton btn btn-success'
                ]).
    '</div>';
  }