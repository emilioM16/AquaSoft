<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use derekisbusy\panel\PanelWidget;
use yii\bootstrap\Modal;
use kartik\tabs\TabsX;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url;
use kartik\alert\AlertBlock;
use kartik\alert\Alert;
use kartik\growl\Growl;
/* @var $this yii\web\View */
/* @var $model app\models\Acuario */

$this->title = $acuario->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Acuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="jumboIdAcuario" class="jumbotron">
  <h2 id="tituloJumboAcuario">Acuario <?= $acuario->nombre ?></h2>
</div>

<div class="row content">
  <div class="col-lg-12">


    <!-- Panel de información -->
    <div class="col-lg-4">
    <?php

      echo AlertBlock::widget([
        'useSessionFlash' => true,
        'type' => AlertBlock::TYPE_GROWL,
        'alertSettings' => [
          'success' => [
            'title' => 'Realización de tarea satisfactoria',
            'icon' => 'glyphicon glyphicon-ok-sign',
            'showSeparator' => true,
            'type' => Growl::TYPE_SUCCESS,
            'pluginOptions' => [
              'showProgressbar' => true,
              'placement' => [
                  'from' => 'top',
                  'align' => 'center',
              ]
            ]
          ],
          'error' => [
            'title' => 'Error',
            'icon' => 'glyphicon glyphicon-exclamation-sign',
            'showSeparator' => true,
            'type' => Growl::TYPE_DANGER,
            'delay'=>0,
            'pluginOptions' => [
              'delay'=>0,
              'showProgressbar' => true,
              'placement' => [
                  'from' => 'top',
                  'align' => 'center',
              ]
            ]
          ]
        ]


        ]);
      
      if($acuario->descripcion==''){
        $acuario->descripcion = 'No hay.';
      }

      $content1 =

      '<div class="col-lg-12">

          <label><u>Nombre del acuario</u> :</label> <span>'.$acuario->nombre.'</span>
          <br><br>

          <p class="text-justify">
            <label><u>Descripción</u>:</label> '
              .$acuario->descripcion.
          '</p>
          <br>

          <label><u>Espacio disponible</u>: </label> <span>'.$acuario->espacioDisponible.' de '.$acuario->capacidadMaxima.' unidades</span>
          <br><br>

      </div>' ;


      if(Yii::$app->user->can('administrarTareas')){
        $visibility = 'visible';
      }else{
        $visibility='hidden';
      }


        $items = [
          [
              'label'=>FA::icon('info')->size(FA::SIZE_LARGE).' Información',
              'content'=>$content1,
          ],
          [
              'label'=>FA::icon('thermometer-3')->size(FA::SIZE_LARGE).' Condiciones ambientales',
              'content'=>'<div class="row">
                            <div class="col-lg-12" align="center">'.
                                $this->render('_gauges',['condiciones'=>$condiciones])
                            .'</div>
                            </div>
                            <div class="row">
                            <div class="col-lg-12" align="center">'.
                                Html::button(FA::icon('check-square-o')->size(FA::SIZE_LARGE).' Nuevo control',
                                [
                                    'value' => Url::to(['task/control','idAcuario'=>$acuario->idAcuario,'idTarea'=>-1]),
                                    'title' => 'Nuevo control',
                                    'class' => 'showModalButton btn btn-primary',
                                    'style'=>['width'=>'70%','visibility'=>$visibility],
                                ])
                            .'</div>
                          </div>',
              'active'=>true,
          ],
          [
            'label'=>FA::icon('pie-chart')->size(FA::SIZE_LARGE).' Población',
            'content'=>$this->render('_population',['especies'=>$especies,'porcentajes'=>$porcentajes]),
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

$JSEventClick = <<<EOT
function(calEvent, jsEvent, view) {

  if(calEvent.editable == true){
    $.ajax({
      type: 'GET',
      url: "/task/execute", 
      data: {idTarea:calEvent.id,idAcuario:$acuario->idAcuario} ,
      dataType: 'html',
      error: function(xhr,err){
        alert("readyState: "+xhr.readyState+" status: "+xhr.status);
        alert("responseText: "+xhr.responseText);
    },
      success: function(response){
          $('#modalContent').html(response);
          $('#modalTitle').html('Realizar tarea');
          $('#modal').modal('show');
          }
    });
  }

}
EOT;
?>

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
                'right'=>'basicDay,month'
            ],
            'options' => [
                'lang' => 'es',
            ],
            'events' => $acuario->events,
            'clientOptions' => [
                'language' => 'es',
                'eventLimit' => TRUE,
                'fixedWeekCount' => false,
                'defaultTimedEventDuration' => '00:01:00',
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
