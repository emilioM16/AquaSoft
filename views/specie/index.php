<?php

use yii\helpers\Html;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FA;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\specie\SpecieSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Especies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specie-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
            echo  Html::button(FA::icon('plus')->size(FA::SIZE_LARGE).' Agregar especie', 
                    [
                    'value' => Url::to(['specie/create']), 
                    'title' => 'Agregar especie', 
                    'class' => 'showModalButton btn btn-success'
                    ]);
        ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nombre',
            'descripcion',
            'minEspacio',
            [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => [

                        'view'=>function($url,$model){
                            return Html::button('<span class="btn-aquarium glyphicon glyphicon-eye-open"></span>', 
                            [
                              'value' => Url::to(['specie/view','id'=>$model->idEspecie]), 
                              'title' => 'Información de la especie: '.$model->nombre, 
                              'class' => 'showModalButton btn btn-warning btnAquarium'
                            ]);

                        },
                       'update'=>function($url,$model){
                        return Html::button('<span class="btn-aquarium glyphicon glyphicon-pencil"></span>', 
                        [
                          'value' => Url::to(['specie/update','id'=>$model->idEspecie]), 
                          'title' => 'Modificar especie: '.$model->nombre, 
                          'class' => 'showModalButton btn btn-primary btnAquarium'
                        ]);
                          },
                          'delete'=>function($url,$model){
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['specie/delete', 'id' => $model->idEspecie], [
                                'class' => 'btn btn-danger btnAquarium',
                                'data' => [
                                    'data-pjax' => '0',
                                    'confirm' => '¿Está seguro de eliminar esta especie ?',
                                    'method' => 'post',
                                ],
                            ]);
                        },
                      ],
                  ],
          ],
    ]); ?>
<?php Pjax::end(); ?></div>
