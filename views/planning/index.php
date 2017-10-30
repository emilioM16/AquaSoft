<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\planning\PlanningSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Planificaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planning-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

        <?= Html::a('Nueva planificacion', ['create'], ['class' => 'btn btn-success']) ?>
      
    </p>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'idPlanificacion',
            'titulo',
            [
            'attribute'=>'anioMes',
            'format' => ['date','php:m-Y']
            ],
            [
            'attribute'=>'fechaHoraCreacion',
            'format' => ['date','php:d-m-Y']
            ],
            [
            'attribute' => 'ACUARIO_USUARIO_acuario_idAcuario',
            'value' => 'aCUARIOUSUARIOAcuarioIdAcuario.nombre',
            ],
            //'activo',
            // 'ACUARIO_USUARIO_usuario_idUsuario',
            'ESTADO_PLANIFICACION_idEstadoPlanificacion',

            [
      'class' => 'yii\grid\ActionColumn',
      'template' => '{check} {down}{view} {update} ',
      'buttons' => [
          'check' => function ($url) {
              return Html::a(
                  '<span class="glyphicon glyphicon-check"></span>',

                  $url,
                  [ 'planning/check'
                  ]
              );
          },
          'down' => function ($url) {
               return Html::a(
                 '<span class="glyphicon glyphicon-trash"></span>',

                $url,
                ['planning/down'
                ]
             );
           }
      ],
  ],



        ],
    ]); ?>
<?php Pjax::end(); ?></div>
