<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Aquarium */

$this->title = $model->idacuario;
$this->params['breadcrumbs'][] = ['label' => 'Aquaria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aquarium-view">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idacuario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idacuario], [
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
            'idacuario',
            'nombre',
            'descripcion',
            'espaciodisponible',
            'activo',
        ],
    ]) ?>

</div>
