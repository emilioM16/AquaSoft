<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\data\ArrayDataProvider;
use rmrevin\yii\fontawesome\FA;
use kartik\tabs\TabsX;


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
    
    <?php

    $items = [
        [
            'label'=>Html::img('@web/img/fishadd.svg',['class'=>'icon']).' Incorporar',
            'content'=>$this->render('_add',['species'=>$species,'model'=>$model]),
            'active'=>true
        ],
        [
            'label'=>Html::img('@web/img/fishtransfer.svg',['class'=>'icon']).' Transferir',
            'content'=>$this->render('_transfer'),
        ],
        [
            'label'=>Html::img('@web/img/fishremove.svg',['class'=>'icon']).' Quitar',
            'content'=>$this->render('_remove'),
        ],
    ];
              



    echo TabsX::widget([
        'id'=>'specimensTabs',
        'items'=>$items,
        'position'=>TabsX::POS_ABOVE,
        'align'=>TabsX::ALIGN_CENTER,
        'bordered'=>true,
        'encodeLabels'=>false
    ]);

    ?>
    </div>
    </div>


</div>