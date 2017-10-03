<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
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
<?php Pjax::end(); 

// Modal::begin([
//     'id'=>'newSpecialistModal', 
//     'size'=>'modal-md',
//     'closeButton'=>[],
//     'header'=> 'Agregar especialista',
//     'headerOptions'=> ['class'=>'h3 text-center'],
//     'footer'=>
//         Html::button(FA::icon('save')->size(FA::SIZE_LARGE).' Guardar', ['class' => 'btn btn-success']).
//         Html::button(FA::icon('remove')->size(FA::SIZE_LARGE).' Cancelar',['class' => 'btn btn-danger','data-dismiss'=>'modal'])

//     ]);

//     echo '<div class="contenidoModal">'.$this->render('_form').'</div>';
    
// Modal::end();

?></div>
