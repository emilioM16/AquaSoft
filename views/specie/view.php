<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\specie\Specie */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Especies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specie-view">

    <h1><?= Html::encode($this->title) ?></h1>
<br><br>
    <div class="col-lg-10 form-left">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
    //        'idEspecie',
            'nombre',
            'descripcion',
        ],
    ]) ?>
    <br><br>
  <div class="planning-form col-lg-6">
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
        //    'activo',
        ],
    ]) ?>
<br><br>

    <?php

    echo '<div>'
   .Html::a('Volver al inicio', ['specie/index'], [
            'class' => 'btn btn-primary',
            'data' => [
                'method' => 'post',
              ],
        ]).
      '</div>';

    ?>
      </div>
</div>


</div>
