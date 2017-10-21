<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\planning\PlanningSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Planificaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planning-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nueva planificacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idPlanificacion',
            'titulo',
            'anioMes',
            'fechaHoraCreacion',
            'activo',
            'ACUARIO_USUARIO_acuario_idAcuario',
            // 'ACUARIO_USUARIO_usuario_idUsuario',
            // 'ESTADO_PLANIFICACION_idEstadoPlanificacion',

            ['class' => 'yii\grid\ActionColumn'],
            
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
