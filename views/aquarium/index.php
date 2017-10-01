<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
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
                    'class' => 'inModal btn btn-success',
                    'data-pjax'=>'0',
                ]).
        '</p>';
    ?>




    <div class="acuarioSearchForm">
        <?php $form = ActiveForm::begin([
            'method'=>'get',
            'options' =>['data-pjax'=>true],
            'action' => Url::to(['aquarium/index']), //importante, previene que se apilen los parametros en método get
            ]); ?>
        <?= $form->field($searchModel, 'nombre') ?>
        <div class="form-group">
            <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
        

    <?= ListView::widget([
       'dataProvider' => $dataProvider,
       'itemView' => '_item',
    ]);


    Modal::begin([
        'id'=>'pModal', 
        'size'=>'modal-md',
        'closeButton'=>[]
        ]);

        echo '<div class="contenidoModal"></div>';
    
    Modal::end();

    ?> 
<?php Pjax::end(); ?></div>
    