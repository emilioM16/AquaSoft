<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aquarium */

$this->title = 'Update Aquarium: ' . $model->idacuario;
$this->params['breadcrumbs'][] = ['label' => 'Aquaria', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idacuario, 'url' => ['view', 'id' => $model->idacuario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aquarium-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
