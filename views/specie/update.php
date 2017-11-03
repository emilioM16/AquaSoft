<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\specie\Specie */

$this->title = 'Update Specie: ' . $model->idEspecie;
$this->params['breadcrumbs'][] = ['label' => 'Species', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idEspecie, 'url' => ['view', 'id' => $model->idEspecie]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="specie-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
