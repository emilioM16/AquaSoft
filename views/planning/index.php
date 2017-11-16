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
<div class="planning-index" align="center">

<h1><?= Html::encode($this->title) ?></h1>
<hr>
    <p>
    <?php if(Yii::$app->user->can('crearPlani')){
    echo  Html::a(FA::icon("plus")->size(FA::SIZE_LARGE).' Nueva planificación', ['create'], ['class' => 'btn btn-success']);
    }?>
    </p>


<?php Pjax::begin(); ?>

<?php

if (Yii::$app->user->can('autorizar-rechazar')) {
  $template = '{view}{check}';
}else{
  $template = '{view}{check}{down}';
}


  echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-hover table-bordered table-striped'],    
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'titulo',
            [
            'attribute'=>'anioMes',
            'format' => ['date','php:m-Y'],
            ],
            [
            'attribute' => 'ACUARIO_USUARIO_acuario_idAcuario',
            'value' => 'aCUARIOUSUARIOAcuarioIdAcuario.nombre',
            ],
            [
            'attribute'=>'ESTADO_PLANIFICACION_idEstadoPlanificacion',
            'filter'=>['Aprobado'=>'Aprobada','Rechazado'=>'Rechazada','SinVerificar'=>'Sin verificar'],
            ],
            [
            'class' => 'yii\grid\ActionColumn',
            'template' => $template,

            'buttons' => [

              'view'=>function($url,$model){
                  return Html::a('<span class="btn-aquarium glyphicon glyphicon-eye-open"></span>',
                  ['planning/view','id'=>$model->idPlanificacion],
                  ['class' => 'btn btn-info btnAquarium']
                );

              },
             'check'=>function($url,$model){
              if (Yii::$app->user->can('autorizar-rechazar')) {
                if ($model->ESTADO_PLANIFICACION_idEstadoPlanificacion=='SinVerificar') {
                    return Html::a(FA::icon("calendar-check-o")->size(FA::SIZE_LARGE),
                    ['planning/check','id'=>$model->idPlanificacion],
                    ['class' => 'btn btn-success btnAquarium']
                    );
                  }else {
                    //NO SE CREA EL BOTÓN
                  }
                }else{
                  if ($model->ESTADO_PLANIFICACION_idEstadoPlanificacion=='SinVerificar') {
                    return Html::a('<span class="btn-aquarium glyphicon glyphicon-pencil"></span>',
                    ['planning/update','id'=>$model->idPlanificacion],
                    ['class' => 'btn btn-primary btnAquarium']

                    );
                  }
                }

              },
              'down'=>function($url,$model,$key){
                if (!Yii::$app->user->can('autorizar-rechazar')) {
                  if ($model->ESTADO_PLANIFICACION_idEstadoPlanificacion=='SinVerificar') {
                  return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['planning/down', 'id' => $model->idPlanificacion], [
                      'class' => 'btn btn-danger btnAquarium',
                      'data' => [
                          'data-pjax' => '0',
                          'confirm' => '¿Está seguro de eliminar la planificacion ?',
                          'method' => 'post',
                      ],
                  ]);
                  }
                  else{
                    //NO SE CREA EL BOTÓN
                  }
                }else{

                }
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
        ?>


<?php Pjax::end(); ?></div>
