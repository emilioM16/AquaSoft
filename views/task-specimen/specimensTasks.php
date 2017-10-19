<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\data\ArrayDataProvider;
use rmrevin\yii\fontawesome\FA;
use kartik\tabs\TabsX;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchConditions */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ejemplares';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specimen-index">

    <h2 class="text-center"><?= Html::encode($this->title) ?></h2>
    <h4 class="text-center"> Seleccione una opción </h4>
    <hr>

    <div class="row specimensOptions form-center">
    
        <div class="col-lg-12"> 
             
 
            <div class="col-lg-4 "> 
                <?= Html::button(Html::img( 
                    '@web/img/fishadd.svg', 
                    [ 
                        'class'=>'img-responsive',                     
                        'data-toggle'=>'tooltip', 
                        'data-placement'=>'bottom', 
                        'title'=>'Incorporar', 
                    ]), 
                    [
                    'value' => Url::to(['task-specimen/add-remove','taskType'=>'Add']), 
                    'title' => 'Incorporar ejemplares', 
                    'class' => 'showModalButton btn btn-default btnSpecimen',
                    ]) 
                ?> 
            </div> 
 
            <div class="col-lg-4 "> 
                <?= Html::button(Html::img( 
                    '@web/img/fishtransfer.svg', 
                    [ 
                        'class'=>'img-responsive', 
                        'data-toggle'=>'tooltip', 
                        'data-placement'=>'bottom', 
                        'title'=>'Transferir', 
                    ]), 
                    [
                    'value' => Url::to(['task-specimen/']), 
                    'title' => 'Transferir ejemplares', 
                    'class' => 'showModalButton btn btn-default btnSpecimen',
                    ]) 
                ?> 
            </div> 
 
            <div class="col-lg-4"> 
                <?= Html::button(Html::img( 
                    '@web/img/fishremove.svg', 
                    [ 
                        'class'=>'img-responsive', 
                        'data-toggle'=>'tooltip', 
                        'data-placement'=>'bottom', 
                        'title'=>'Quitar', 
                    ]), 
                    [
                    'value' => Url::to(['task-specimen/add-remove','taskType'=>'Remove']), 
                    'title' => 'Quitar ejemplares', 
                    'class' => 'showModalButton btn btn-default btnSpecimen',
                    ]) 
                ?> 
            </div> 
        </div> 
    </div> 
</div>