<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\planning\Planning */

$this->title = $model->idPlanificacion;
$this->params['breadcrumbs'][] = ['label' => 'Plannings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planning-view">

  <h1><?= Html::encode($this->title) ?></h1>

  <?= $this->render('calendar', [
      'model' => $model,
  ]) ?>


</div>
