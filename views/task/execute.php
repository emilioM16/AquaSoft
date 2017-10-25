<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\task\Task */

$this->title = 'Tipo: ' . $tarea->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $tarea->idTarea, 'url' => ['view', 'id' => $tarea->idTarea]];
$this->params['breadcrumbs'][] = 'Execute';
?>
<div class="task-execute"> 
    <h3><?= Html::encode($this->title) ?></h4>
    <!-- Áquí el resto de los atributos -->
    

</div>
