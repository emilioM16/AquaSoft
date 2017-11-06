<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\task\Task */

$this->title = 'Actualizar tarea: ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Tarea', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->idTarea, 'url' => ['view', 'id' => $model->idTarea]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="task-update">

    <?= $this->render('_form', [
        'model' => $model,
        'taskTypes'=>$taskTypes
    ]) ?>

</div>
