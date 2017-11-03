<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\specie\SpecieSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Species';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specie-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Specie', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idEspecie',
            'nombre',
            'descripcion',
            'minPH',
            'maxPH',
            // 'minTemp',
            // 'maxTemp',
            // 'minSalinidad',
            // 'maxSalinidad',
            // 'minLux',
            // 'maxLux',
            // 'minEspacio',
            // 'minCO2',
            // 'maxCO2',
            // 'activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
