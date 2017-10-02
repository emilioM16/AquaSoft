<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;
?>

  <div id="acuario" class="acuarios col-sm-6 col-md-4 col-lg-2">
    <div class="thumbnail">
      <img src="/img/itemAcuario.jpg">
      <div class="caption">
        <h3><?=$model->nombre?></h3>
        <?php 
          if (!isset($model->id_condiciones_ambientales)){
           echo "<p><span class='label label-danger'>Habitat no cargado</span></p>";
          };
        ?>
        <p>
            <?php
              // echo Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
              //               [
              //                 'view',
              //                 'idacuario'=>$model->idacuario,
              //                 // 'nombre' => $model->nombre, 
              //                 // 'id_condiciones_ambientales' => $model->id_condiciones_ambientales, 
              //                 // 'usuarios_nombre_usuario' => $model->usuarios_nombre_usuario
              //               ], 
              //               [
              //                 'class' => 'inModal viewAquarium',
              //                 'data-pjax' => '0',
              //                 'method'=>'get'
              //               ]);

              echo  Html::button('<span class="glyphicon glyphicon-eye-open"></span>', 
                    [
                      'value' => Url::to(['aquarium/view','idacuario'=>$model->idacuario]), 
                      'title' => 'Información del acuario '.$model->nombre, 
                      'class' => 'showModalButton btn btn-success btnAquarium'
                    ]);

              
              echo  Html::button('<span class="btn-aquarium glyphicon glyphicon-pencil"></span>', 
                    [
                      'value' => Url::to(['aquarium/update','idacuario'=>$model->idacuario]), 
                      'title' => 'Modificar acuario '.$model->nombre, 
                      'class' => 'showModalButton btn btn-primary btnAquarium'
                    ]);


              // echo Html::a('<span class="glyphicon glyphicon-trash"></span>',
              //               [
              //                 'delete',
              //                 'nombre' => $model->nombre,
              //                 // 'id_condiciones_ambientales' => $model->id_condiciones_ambientales,
              //                 // 'usuarios_nombre_usuario' => $model->usuarios_nombre_usuario
              //               ],
              //               [
              //                 'class' => 'inModal',
              //                 'data-pjax' => '0'
              //             ]);


              echo  Html::button('<span class="glyphicon glyphicon-trash"></span>', 
              [
                'value' => Url::to(['aquarium/delete','idacuario'=>$model->idacuario]), 
                'title' => 'Eliminar acuario', 
                'class' => 'btn btn-danger showModalButton btnAquarium'
              ]);

              echo Html::a('Detalle', 
                            [
                              'detail',
                              'nombreacuario' => $model->nombre,
                              'idacuario'=>$model->idacuario,
                              // 'usuarios_nombre_usuario' => $model->usuarios_nombre_usuario,
                              // 'id_condiciones_ambientales' => $model->id_condiciones_ambientales,
                            ],
                            [
                              'class'=>'btn btn-md btn-primary pull-right',
                              'method'=>'get',
                              // 'data'=>[
                              //   'method'=>'get',
                              //   'params'=>[
                              //     'nombre'=>$model->nombre,
                              //     'usuarios_nombre_usuario'=>$model->usuarios_nombre_usuario,
                              //     'idCondiciones'=> $model->id_condiciones_ambientales,
                              //   ],
                              // ]
                            ]);
            ?>
        </p>
      </div>
    </div>
  </div>