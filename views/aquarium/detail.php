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
        ]);
        ?>
      </div>
    </div>
  </div>

  <?php 
  if(Yii::$app->user->can('administrarTareas')){
    // echo '<div id="btnDetail" class="col-lg-2">'
    //       .Html::button(FA::icon('plus')->size(FA::SIZE_LARGE).' Agregar tarea no planificada',['class'=>'btn btn-success']).
    //   '</div>';
    echo '<div id="btnDetail" class="col-lg-2">'
      .Html::button(FA::icon('plus')->size(FA::SIZE_LARGE).' Agregar tarea no planificada', 
                [
                'value' => Url::to(['task/create',
                      'idAcuario'=>$acuario->idAcuario,
                      'idPlanificacion'=>-1, // esto significa que es no planificada
                      'fecha'=>date("Y-m-d")
                  ]), 
                'title' => 'Agregar tarea no planificada', 
                'class' => 'showModalButton btn btn-success'
                ]).
    '</div>';
  }