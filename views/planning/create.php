<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\planning\Planning */

$this->params['breadcrumbs'][] = ['label' => 'Planificaciones', 'url' => ['index']];
$this->title = 'Nueva planificación';


?>
    <h1 align="center"><?= Html::encode($this->title) ?></h1>
    <hr>
<div class="planning-update">

    <?= $this->render('_form', [
        'model' => $model,
        'aquariums'=>$aquariums,
    ]) ?>

</div>
