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
            .Html::button(FA::icon('plus')->size(FA::SIZE_LARGE).' Agregar acuario', 
            [
            'value' => Url::to(['aquarium/create']), 
            'title' => 'Agregar acuario', 
            'class' => 'showModalButton btn btn-success'
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
    ?> 
<?php Pjax::end(); ?></div>
    