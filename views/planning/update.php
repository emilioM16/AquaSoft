<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\planning\Planning */

$this->title = 'Update Planning: ' . $model->idPlanificacion;
$this->params['breadcrumbs'][] = ['label' => 'Plannings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPlanificacion, 'url' => ['view', 'id' => $model->idPlanificacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="planning-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
