<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\planning\Planning */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Plannings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planning-check">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idPlanificacion',
            'titulo',
            'anioMes',
            //'fechaHoraCreacion',
            //'activo',
            'ACUARIO_USUARIO_acuario_idAcuario',
            //'ACUARIO_USUARIO_usuario_idUsuario',
            //'ESTADO_PLANIFICACION_idEstadoPlanificacion',
        ],
    ]) ?>



    <p>
        <?= Html::a('Autorizar', ['autorized', 'id' => $model->idPlanificacion], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => '¿Esta seguro que desea autorizar esta planificacion?',
                'method' => 'post',
              ],
            ]) ?>


        <?= Html::a('Rechazar', ['refuse', 'id' => $model->idPlanificacion], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Esta seguro que desea rechazar esta planificacion?',
                'method' => 'post',
            ],
        ]) ?>
    </p>



</div>
