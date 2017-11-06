<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\task\Task */

$this->params['breadcrumbs'][] = ['label' => 'Tarea', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->idTarea], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idTarea], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idTarea',
            'titulo',
            'descripcion',
            'fechaHoraInicio',
            'fechaHoraFin',
            'fechaHoraRealizacion',
            'PLANIFICACION_idPlanificacion',
            'USUARIO_idUsuario',
            'ACUARIO_idAcuario',
            'TIPO_TAREA_idTipoTarea',
        ],
    ]) ?>

</div>
