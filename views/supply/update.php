<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\supply\Supply */

$this->title = 'Modificar insumo: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Insumos', 'url' => ['index']];

$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="supply-update">


    <?= $this->render('_form', [
        'model' => $model,
        'taskTypes'=>$taskTypes
    ]) ?>

</div>
