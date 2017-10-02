<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FA;
/* @var $this yii\web\View */
/* @var $model app\models\Aquarium */

$this->title = $model->idacuario;
$this->params['breadcrumbs'][] = ['label' => 'Aquaria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aquarium-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idacuario',
            'nombre',
            'descripcion',
            'espaciodisponible',
            'activo',
        ],
    ]) ?>
<br>
<div class="form-group" align="center">
        <?= Html::button(FA::icon('remove')->size(FA::SIZE_LARGE).' Cancelar',['class' => 'btn btn-danger','data-dismiss'=>'modal']) ?>
    </div>
</div>
