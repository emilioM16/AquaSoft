<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\task\Task */

$this->title = 'Realizar tarea: ' . $tarea->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $tarea->idTarea, 'url' => ['view', 'id' => $tarea->idTarea]];
$this->params['breadcrumbs'][] = 'Execute';
?>
<div class="task-execute"> 
    <h2><?= Html::encode($this->title) ?></h2>
    <!-- Áquí el resto de los atributos -->
    

</div>
