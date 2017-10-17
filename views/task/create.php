<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\task\Task */

$this->title = 'Crear tarea';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create">

    <?= $this->render('_form', [
        'model' => $model,
        'taskTypes'=>$taskTypes
    ]) ?>

</div>
