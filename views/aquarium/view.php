<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FA;
use kartik\form\ActiveForm;
use kartik\builder\Form;
/* @var $this yii\web\View */
/* @var $model app\models\Aquarium */

$this->title = $model->idAcuario;
$this->params['breadcrumbs'][] = ['label' => 'Acuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aquarium-view">

    

    <div align="center">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'descripcion',
            'capacidadMaxima',
            'espacioDisponible',
            [
                'attribute'=>'activo',
                'value'=>$model->activo == 1 ? 'Si' : 'No'
            ]
        ],
        'class'=>['form-center']
    ]) ?>
    </div>
<br>
<div class="form-group" align="center">
        <?= Html::button(FA::icon('remove')->size(FA::SIZE_LARGE).' Cancelar',['class' => 'btn btn-danger','data-dismiss'=>'modal']) ?>
    </div>
</div>
