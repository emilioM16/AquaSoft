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
          if (empty($model->enviromentalConditions)){
           echo "<p><span class='label label-danger'>Habitat no cargado</span></p>";
          }else{
            echo "<p><span class='label label-success'>Habitat cargado</span></p>";
          }
        ?>
        <p>
            <?php
              echo  Html::button('<span class="glyphicon glyphicon-eye-open"></span>',
                    [
                      'value' => Url::to(['aquarium/view','idAcuario'=>$model->idAcuario]),
                      'title' => 'Información del acuario '.$model->nombre,
                      'class' => 'showModalButton btn btn-success btnAquarium'
                    ]);

              if (Yii::$app->user->can('modificarAcuario')){

                  echo  Html::button('<span class="btn-aquarium glyphicon glyphicon-pencil"></span>',
                        [
                          'value' => Url::to(['aquarium/update','idAcuario'=>$model->idAcuario]),
                          'title' => 'Modificar acuario '.$model->nombre,
                          'class' => 'showModalButton btn btn-primary btnAquarium',
                        ]);
              }

              if(Yii::$app->user->can('bajaAcuario')){

                if($model->activo==0){
                  echo Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['change-state', 'id' => $model->idAcuario], [
                      'class' => 'btn btn-success btnAquarium',
                      'title'=>'Dar de alta',
                      'data' => [
                          'data-pjax' => '0',
                          'confirm' => '¿Está seguro de querer dar de alta el acuario "'.$model->nombre.'"?',
                          'method' => 'post',
                      ],
                  ]);
                }else{
                    echo Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['change-state', 'id' => $model->idAcuario], [
                        'class' => 'btn btn-danger btnAquarium',
                        'title'=>'Dar de baja',
                        'data' => [
                            'data-pjax' => '0',
                            'confirm' => '¿Está seguro de querer dar de baja el acuario "'.$model->nombre.'"?',
                            'method' => 'post',
                        ],
                    ]);
                }
            }

              echo Html::a('Detalle',
                            [
                              'detail',
                            ],
                            [
                              'class'=>'btn btn-md btn-primary pull-right',
                              'method'=>'post',
                              'data'=>[
                                'method'=>'post',
                                'params'=>[
                                  'idAcuario'=>$model->idAcuario,
                                ],
                              ]
                            ]);
            ?>
        </p>
      </div>
    </div>
  </div>
