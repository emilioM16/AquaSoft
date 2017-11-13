<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Especialistas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index" align="center">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <?php 
     echo   '<p>'
            .Html::button(FA::icon('plus')->size(FA::SIZE_LARGE).' Agregar especialista', 
            [
            'value' => Url::to(['user/create']), 
            'title' => 'Agregar especialista', 
            'class' => 'showModalButton btn btn-success'
            ]).
        '</p>';
?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nombre',
            'apellido',
            'nombreUsuario',
            'email:email',
            [
                'attribute'=>'activo',
                'filter'=>[1=>'Si',0=>'No'],
                'value'=>function($model, $key, $index, $widget){
                    if($model->activo==1){
                        return 'Si';
                    }else{
                        return 'No';
                    };
                }
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{update}{delete}',
                'buttons' => [
                    'view'=>function($url,$model){
                        return Html::button('<span class="btn-aquarium glyphicon glyphicon-eye-open"></span>', 
                        [
                          'value' => Url::to(['user/view','id'=>$model->idUsuario]), 
                          'title' => 'Información del especialista: '.$model->nombreUsuario, 
                          'class' => 'showModalButton btn btn-warning btnAquarium'
                        ]);
                    },
                    'update'=>function($url,$model){
                        return Html::button('<span class="btn-aquarium glyphicon glyphicon-pencil"></span>', 
                        [
                          'value' => Url::to(['user/update','id'=>$model->idUsuario]), 
                          'title' => 'Modificar especialista: '.$model->nombreUsuario, 
                          'class' => 'showModalButton btn btn-primary btnAquarium'
                        ]);
                    },
                    'delete' => function($url, $model){
                        if($model->activo==0){
                            return Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['change-state', 'id' => $model->idUsuario], [
                                'class' => 'btn btn-success btnAquarium',
                                'data' => [
                                    'data-pjax' => '0',
                                    'confirm' => '¿Está seguro de querer dar de alta el usuario "'.$model->nombreUsuario.'"?',
                                    'method' => 'post',
                                ],
                            ]);
                        }else{
                            return Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['change-state', 'id' => $model->idUsuario], [
                                'class' => 'btn btn-danger btnAquarium',
                                'data' => [
                                    'data-pjax' => '0',
                                    'confirm' => '¿Está seguro de querer dar de baja el usuario "'.$model->nombreUsuario.'"?',
                                    'method' => 'post',
                                ],
                            ]);
                        }
                    }
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); 

?></div>
