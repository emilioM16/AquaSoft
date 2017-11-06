<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\planning\Planning */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Planificaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="planning-view">



  <?= $this->render('calendar', [
      'model' => $model,
  ]) ?>


</div>
