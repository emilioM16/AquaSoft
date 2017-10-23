<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View\Task */
/* @var $model app\models\task\Task */

$this->title = 'Tipo: ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTarea, 'url' => ['view', 'id' => $model->idTarea]];
$this->params['breadcrumbs'][] = 'Maintenance';
?>
<div class="task-maintenance">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_supply', [
        'model' => $model,
    ]) ?>

</div>
