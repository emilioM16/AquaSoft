<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\planning\Planning */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Planificaciones', 'url' => ['index']];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planning-check">


  <?= $this->render('calendar', [
      'model' => $model,

  ]) ?>




</div>
