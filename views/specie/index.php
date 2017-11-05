<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\specie\SpecieSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Especies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specie-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Agregar especie', ['create'], ['class' => 'btn btn-success']) ?>
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
                            return Html::a('<span class="btn-aquarium glyphicon glyphicon-eye-open"></span>',
                            ['specie/view','id'=>$model->idEspecie],
                            ['class' => 'btn btn-info btnAquarium']
                          );

                        },
                       'update'=>function($url,$model){
                            return Html::a('<span class="btn-aquarium glyphicon glyphicon-pencil"></span>',
                            ['specie/update','id'=>$model->idEspecie],
                            ['class' => 'btn btn-success btnAquarium']
                            );
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
