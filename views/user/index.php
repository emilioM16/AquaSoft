<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Especialistas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo especialista', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_usuario',
            'nombre',
            'apellido',
            'nombre_usuario',
            'email:email',
            [
                'attribute'=>'activo',
                'value'=>function($model, $key, $index, $widget){
                    if($model->activo==1){
                        return 'Si';
                    }else{
                        return 'No';
                    };
                }
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}{delete}'
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>