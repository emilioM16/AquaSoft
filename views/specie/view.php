<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\models\specie\Specie */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Especies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specie-view form-center" align="center">

<br>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'descripcion',
        ],
    ]) ?>
    <!-- <br><br> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>
<br><br>

<?= Html::button(FA::icon('remove')->size(FA::SIZE_LARGE).' Cerrar',['class' => 'btn btn-danger','data-dismiss'=>'modal']) ?>


</div>

