<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\planning\Planning */

//$this->title = 'Update Planning: ' . $model->idPlanificacion;
$this->params['breadcrumbs'][] = ['label' => 'Plannings', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->idPlanificacion, 'url' => ['view', 'id' => $model->idPlanificacion]];
$this->params['breadcrumbs'][] = 'Crear';



?>
<div class="planning-update">



    <?= $this->render('_form', [
        'model' => $model,
        'aquariums'=>$aquariums,
    ]) ?>

</div>
