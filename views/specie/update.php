<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\specie\Specie */

$this->title = 'Modificar especie: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Especies', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="specie-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
