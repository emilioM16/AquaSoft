<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;
/* @var $this yii\web\View */
/* @var $searchModel app\models\supply\SupplySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Insumos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supply-index" align="center">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <p>
    <?php
            echo  Html::button(FA::icon('plus')->size(FA::SIZE_LARGE).' Agregar insumo', 
                    [
                    'value' => Url::to(['supply/create']), 
                    'title' => 'Agregar insumo', 
                    'class' => 'showModalButton btn btn-success'
                    ]);
        ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-hover table-bordered'],        
        'rowOptions' => function ($model, $key, $index, $column) {
            $color = "";
            if(($model->stock <= 5) && ($model->stock >= 1)){
              $color = "warning";
            }elseif($model->stock == 0){
              $color = "danger";
            }
            return ['class' => $color];
          },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre',
            'descripcion',
            'stock',
            [
                'attribute'=>'TIPO_TAREA_idTipoTarea',
                'filter'=>[
                    'Alimentación'=>'Alimentación',
                    'Controlar acuario'=>'Controlar acuario',
                    'Limpieza'=>'Limpieza',
                    'Reparación'=>'Reparación',
                    ]
            ],
            ['class' => 'yii\grid\ActionColumn',

            'template'=>'{view}{update}{delete}',
            'buttons' => [
                'view'=>function($url,$model){
                    return Html::button('<span class="btn-aquarium glyphicon glyphicon-eye-open"></span>', 
                    [
                      'value' => Url::to(['supply/view','id'=>$model->idInsumo]), 
                      'title' => 'Información del insumo: '.$model->nombre, 
                      'class' => 'showModalButton btn btn-warning btnAquarium'
                    ]);

                },
               'update'=>function($url,$model){
                return Html::button('<span class="btn-aquarium glyphicon glyphicon-pencil"></span>', 
                [
                  'value' => Url::to(['supply/update','id'=>$model->idInsumo]), 
                  'title' => 'Modificar insumo: '.$model->nombre, 
                  'class' => 'showModalButton btn btn-primary btnAquarium'
                ]);
                  },
                  'delete'=>function($url,$model){
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['supply/delete', 'id' => $model->idInsumo], [
                        'class' => 'btn btn-danger btnAquarium',
                        'data' => [
                            'data-pjax' => '0',
                            'confirm' => '¿Está seguro de eliminar este insumo?',
                            'method' => 'post',
                        ],
                    ]);
                }
            ]

          ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
