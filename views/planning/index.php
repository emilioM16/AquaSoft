<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
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
    <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idPlanificacion',
            'titulo',
            'anioMes',
            'fechaHoraCreacion',
            'activo',
            'ACUARIO_USUARIO_acuario_idAcuario',
            // 'ACUARIO_USUARIO_usuario_idUsuario',
            // 'ESTADO_PLANIFICACION_idEstadoPlanificacion',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{update}{delete}{checkdate}',
                'buttons' => [
                    'view'=>function($url,$model){
                        return Html::button('<span class="btn-aquarium glyphicon glyphicon-eye-open"></span>',
                        [
                          //'value' => Url::to(['planning/view','id'=>$model->idPlanificacion]),
                          'title' => 'Información de la planificacion',
                          'class' => 'showModalButton btn btn-warning btnAquarium'
                        ]);
                    },
                    'update'=>function($url,$model){
                        return Html::button('<span class="btn-aquarium glyphicon glyphicon-pencil"></span>',
                        [
                        //  'value' => Url::to(['planning/update','id'=>$model->idPlanificacion]),
                          'title' => 'Modificar especialista: ',
                          'class' => 'showModalButton btn btn-primary btnAquarium'
                        ]);
                    },
                    'delete' => function($url, $model){
                        if($model->activo==0){
                            return Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['change-state', 'id' => $model->idPlanificacion], [
                                'class' => 'btn btn-success btnAquarium',
                                'data' => [
                                    'data-pjax' => '0',
                                    'confirm' => '¿Está seguro de querer dar de alta el usuario "'.$model->idPlanificacion.'"?',
                                    'method' => 'post',
                                ],
                            ]);
                        }else{
                            return Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['change-state', 'id' => $model->idPlanificacion], [
                                'class' => 'btn btn-danger btnAquarium',
                                'data' => [
                                    'data-pjax' => '0',
                                    'confirm' => '¿Está seguro de querer dar de baja el usuario "'.$model->idPlanificacion.'"?',
                                    'method' => 'post',
                                ],
                            ]);
                        }
                    }
                ]],


        ],
    ]); ?>
<?php Pjax::end(); ?></div>
