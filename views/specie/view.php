<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\specie\Specie */

$this->title = $model->idEspecie;
$this->params['breadcrumbs'][] = ['label' => 'Species', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specie-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idEspecie], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idEspecie], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idEspecie',
            'nombre',
            'descripcion',
            'minPH',
            'maxPH',
            'minTemp',
            'maxTemp',
            'minSalinidad',
            'maxSalinidad',
            'minLux',
            'maxLux',
            'minEspacio',
            'minCO2',
            'maxCO2',
            'activo',
        ],
    ]) ?>

</div>
