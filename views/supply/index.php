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

            'idInsumo',
            'nombre',
            'descripcion',
            'stock',
            'activo',
            // 'TIPO_TAREA_idTipoTarea',

            ['class' => 'yii\grid\ActionColumn',

            'template'=>'{view}{update}{delete}',
            'buttons' => [
                'view'=>function($url,$model){
                    return Html::button('<span class="btn-aquarium glyphicon glyphicon-eye-open"></span>',
                    [
                      'value' => Url::to(['supply/view']),
                      'title' => 'Información del especialista: ',
                      'class' => 'showModalButton btn btn-warning btnAquarium'
                    ]);
                },
                'update'=>function($url,$model){
                    return Html::button('<span class="btn-aquarium glyphicon glyphicon-pencil"></span>',
                    [
                      'value' => Url::to(['supply/update']),
                      'title' => 'Modificar especialista: ',
                      'class' => 'showModalButton btn btn-primary btnAquarium'
                    ]);
                },
                'delete' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['supply'], [
                            'class' => 'btn btn-success btnAquarium',
                            'data' => [
                                'data-pjax' => '0',
                                'confirm' => '¿Está seguro de querer dar de alta el usuario"?',
                                'method' => 'post',
                            ],
                        ]);

                }
            ]

          ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
