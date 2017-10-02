<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BusquedaUsuario */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Acuarios';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="acuario-index">
    <?php Pjax::begin(['id'=>'idacuario']); ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?=   
        '<p>'
            .Html::a(FA::icon('plus')->size(FA::SIZE_LARGE).' Agregar acuario', 
                [
                    'create'
                ], 
                [
                    'class' => 'inModal btn btn-success addAquarium',
                    'data-pjax'=>'0',
                ]).
        '</p>';
    ?>




    <div class="acuarioSearchForm">
        <?php $form = ActiveForm::begin([
            'layout'=>'inline',
            'method'=>'get',
            'options' =>['data-pjax'=>true],
            'action' => Url::to(['aquarium/index']), //importante, previene que se apilen los parametros en método get
            ]); ?>
        <hr>
        <h4> Buscar acuario </h4>
        <?= $form->field($searchModel, 
            'nombre',
            [
                'inputTemplate'=>'<div id="searchField" class="input-group">{input}<span class="input-group-btn">'.Html::submitButton(FA::icon('search')->size(FA::SIZE_LARGE), ['class' => 'btn btn-primary']).'</span></div>'
            ])->textInput(['placeholder'=>'Acuario']) ?>
        <?php ActiveForm::end(); ?>
    </div>
        

    <?= ListView::widget([
       'dataProvider' => $dataProvider,
       'itemView' => '_item',
    ]);


    Modal::begin([
        'id'=>'addAquariumModal', 
        'size'=>'modal-sm',
        'closeButton'=>[],
        'header'=> 'Agregar acuario',
        'headerOptions'=> ['class'=>'h3  text-center'],
        ]);

        echo '<div class="contenidoModal"></div>';
    
    Modal::end();

    Modal::begin([
        'id'=>'viewAquariumModal', 
        'size'=>'modal-md',
        'closeButton'=>[],
        'header'=> 'Información del acuario',
        'headerOptions'=> ['class'=>'h3  text-center'],
        'footer'=>
            Html::button(FA::icon('remove')->size(FA::SIZE_LARGE).' Cancelar',['class' => 'btn btn-danger','data-dismiss'=>'modal'])
        ]);

        echo '<div class="contenidoModal"></div>';
    
    Modal::end();

    Modal::begin([
        'id'=>'updateAquariumModal', 
        'size'=>'modal-sm',
        'closeButton'=>[],
        'header'=> 'Modificar acuario',
        'headerOptions'=> ['class'=>'h3  text-center'],
        ]);

        echo '<div class="contenidoModal"></div>';
    
    Modal::end();

    ?> 
<?php Pjax::end(); ?></div>
    