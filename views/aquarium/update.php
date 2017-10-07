<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aquarium */

$this->title = 'Modificar acuario: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Acuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idAcuario, 'url' => ['view', 'id' => $model->nombre]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="aquarium-update">


    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
