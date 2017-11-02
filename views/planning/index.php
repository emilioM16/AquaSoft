<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;
use kartik\alert\AlertBlock;
use kartik\alert\Alert;
use kartik\growl\Growl;
/* @var $this yii\web\View */
/* @var $searchModel app\models\planning\PlanningSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Planificaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planning-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

        <?= Html::a('Nueva planificacion', ['create'], ['class' => 'btn btn-success']) ?>

    </p>

<?php Pjax::begin(); ?>

<?php
 if (Yii::$app->user->can('autorizar-rechazar')) {
  echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'titulo',
            [
            'attribute'=>'anioMes',
            'format' => ['date','php:m-Y']
            ],
            [
            'attribute' => 'ACUARIO_USUARIO_acuario_idAcuario',
            'value' => 'aCUARIOUSUARIOAcuarioIdAcuario.nombre',
            ],
            'ESTADO_PLANIFICACION_idEstadoPlanificacion',

            [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}{check}',

            'buttons' => [

              'view'=>function($url,$model){
                  return Html::a('<span class="btn-aquarium glyphicon glyphicon-eye-open"></span>',
                  ['planning/view','id'=>$model->idPlanificacion],
                  ['class' => 'btn btn-info btnAquarium']
                );

              },
             'check'=>function($url,$model){
                  return Html::a('<span class="btn-aquarium glyphicon glyphicon-ok"></span>',
                  ['planning/check','id'=>$model->idPlanificacion],
                  ['class' => 'btn btn-success btnAquarium']
                  );
              },
          ],
  ],

        ],
    ]);

          }

       else{
        //  var_dump('a');

      echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'titulo',
                [
                'attribute'=>'anioMes',
                'format' => ['date','php:m-Y']
                ],
                [
                'attribute' => 'ACUARIO_USUARIO_acuario_idAcuario',
                'value' => 'aCUARIOUSUARIOAcuarioIdAcuario.nombre',
                ],
                'ESTADO_PLANIFICACION_idEstadoPlanificacion',

                [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{down}',

                'buttons' => [

                  'view'=>function($url,$model){
                      return Html::a('<span class="btn-aquarium glyphicon glyphicon-eye-open"></span>',
                      ['planning/view','id'=>$model->idPlanificacion],
                      ['class' => 'btn btn-info btnAquarium']
                    );

                  },
                  'update'=>function($url,$model){
                      return Html::a('<span class="btn-aquarium glyphicon glyphicon-pencil"></span>',
                      ['planning/update','id'=>$model->idPlanificacion],
                      ['class' => 'btn btn-primary btnAquarium']

                      );
                  },
                  'down'=>function($url,$model,$key){
                      return Html::a('<span class="btn-aquarium glyphicon glyphicon-trash"></span>',
                      ['planning/down','id'=>$model->idPlanificacion],
                      ['class' => 'btn btn-danger btnAquarium']
                    ///  ['data-confirm' => Yii::t('yii', 'Are you sure you want to delete selected items?')]
                      );
                  },
              ],
      ],

            ],
        ]);


          echo AlertBlock::widget([
            'useSessionFlash' => true,
            'type' => AlertBlock::TYPE_GROWL,
            'alertSettings' => [
              'success' => [
                'title' => 'Planificacion',
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

              }
        ?>




<?php Pjax::end(); ?></div>
