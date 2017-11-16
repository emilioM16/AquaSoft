<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FA;
/* @var $this yii\web\View */
/* @var $model app\models\supply\Supply */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Insumos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supply-view form-center" align="center">

    <br><br>



        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'descripcion',
                'stock',
                'TIPO_TAREA_idTipoTarea',
            ],
        ]) ?>
        <br><br>

    <?= Html::button(FA::icon('remove')->size(FA::SIZE_LARGE).' Cerrar',['class' => 'btn btn-danger','data-dismiss'=>'modal']) ?>

</div>
