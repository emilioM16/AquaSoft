<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\planning\Planning */

$this->title = $model->idPlanificacion;
$this->params['breadcrumbs'][] = ['label' => 'Plannings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planning-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idPlanificacion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idPlanificacion], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Esta seguro que desea eliminar esta planificacion?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idPlanificacion',
            'titulo',
            'anioMes',
            'fechaHoraCreacion',
            'activo',
            'ACUARIO_USUARIO_acuario_idAcuario',
            'ACUARIO_USUARIO_usuario_idUsuario',
            'ESTADO_PLANIFICACION_idEstadoPlanificacion',
        ],
    ]) ?>

</div>
