<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\supply\SupplySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Insumos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supply-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear insumo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre',
            'descripcion',
            'stock',
             'TIPO_TAREA_idTipoTarea',

            ['class' => 'yii\grid\ActionColumn',

            'template'=>'{view}{update}{delete}',
            'buttons' => [
                'view'=>function($url,$model){
                    return Html::a('<span class="btn-aquarium glyphicon glyphicon-eye-open"></span>',
                    [
                      'view',
                      'id'=>$model->idInsumo
                    ],
                    [
                      'title' => 'Información del insumo: ',
                      'class' => 'btn btn-warning btnAquarium'
                    ]);
                },
                'update'=>function($url,$model){
                    return Html::a('<span class="btn-aquarium glyphicon glyphicon-pencil"></span>',
                    [
                      'update',
                      'id'=>$model->idInsumo
                    ],
                    [
                      'title' => 'Modificar insumo: ',
                      'class' => 'btn btn-primary btnAquarium'
                    ]);
                },
                'delete' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['supply'], [
                            'class' => 'btn btn-danger btnAquarium',
                            'data' => [
                                'data-pjax' => '0',
                                'confirm' => '¿Está seguro de querer eliminar el insumo?',
                                'method' => 'post',
                            ],
                        ]);

                }
            ]

          ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
