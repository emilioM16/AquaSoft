<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title= 'Sistema de gestión AquaSoft';
 ?>

<div class="site-index">


  <div class="row">

    <div class="col-lg-9" align="center">

      <div class="jumbotron col-lg-12">
        <?= Html::img('@web/img/logo.png', ['class'=>'img-responsive form-center']) ?>
      </div>

      <div class="col-lg-4">
        <div class="">
        <?php
          echo Html::a(
            Html::img('@web/img/sea-bottom.png',['class'=>'img-circle img-responsive']),
            ['aquarium/']
          );
        ?>
        <div  class="imgFooter text-center"> Acuarios </div>
        </div>
      </div>

      <?php 
    if (Yii::$app->user->can('verEspecialistas')){

        echo  '<div class="col-lg-4">'
            .Html::a(
                Html::img('@web/img/group.png',['class'=>'img-circle img-responsive']),
                ['user/']
              )
            .'<div  class="imgFooter text-center"> Especialistas </div>
          </div>';
      }else{

        echo '<div class="col-lg-4">'
           .Html::a(
            Html::img('@web/img/fish.png',['class'=>'img-circle ']),
            [Url::toRoute('task-specimen/specimens-tasks')]
          )
            .'<div  class="imgFooter text-center"> Ejemplares </div>
          </div>';
      }
      ?>

      <div class="col-lg-4">
        <?php
          echo Html::a(
            Html::img('@web/img/calendar.png',['class'=>'img-circle img-responsive']),
            ['planning/']
          );
        ?>
        <div  class="imgFooter text-center"> Planificaciones </div>
      </div>
    </div>

    <!-- <div class="col-lg-3">
      <div id="panelNotif" class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title text-center">Notificaciones</h3>
        </div>
        <div class="panel-body">

        <div class="alert alert-info" role="alert">
          Se ha registrado una <a href="#" class="alert-link"><strong>nueva planificación</strong></a> para el acuario A01
        </div>
        <div class="alert alert-danger" role="alert">
          <strong>¡Peligro!</strong> Las <a href="#" class="alert-link">condiciones ambientales </a> del acuario AS03 se encuentran fuera de los umbrales.
        </div>
        <div class="alert alert-warning" role="alert">
          <a href="#" class="alert-link">...</a>
        </div>
        <div class="alert alert-danger" role="alert">
          <a href="#" class="alert-link">...</a>
        </div>




        </div>
      </div>
    </div> -->
    
  </div>
</div>
