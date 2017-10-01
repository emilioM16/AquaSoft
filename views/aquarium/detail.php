<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use derekisbusy\panel\PanelWidget;
use yii\bootstrap\Modal;
use kartik\tabs\TabsX;
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
      
      '<div class="col-lg-12 ">  

          <label>Registrado por: </label> <span> Melo Emilio </span>
          <br><br>

          <p class="text-justify">       
            
            <label>Descripción:</label>

              Este acuario es de agua dulce o salada y tiene muchos peces. 
              Este acuario es de agua dulce o salada y tiene muchos peces.
              Este acuario es de agua dulce o salada y tiene muchos peces.
              Este acuario es de agua dulce o salada y tiene muchos peces.
              Este acuario es de agua dulce o salada y tiene muchos peces. 
              Este acuario es de agua dulce o salada y tiene muchos peces. 
              Este acuario es de agua dulce o salada y tiene muchos peces. 
          </p>            
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


