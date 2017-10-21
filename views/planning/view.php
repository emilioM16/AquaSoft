<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Modal;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\planning\Planning */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Plannings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planning-view">

    <h1><?= Html::encode($this->title) ?></h1>




</div>
