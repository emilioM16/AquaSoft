<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\planning\Planning */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Plannings', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planning-check">

  <h1><?= Html::encode($this->title) ?></h1>

  <?= $this->render('calendar', [
      'model' => $model,
  ]) ?>




</div>
