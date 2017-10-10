<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->idUsuario;
$this->params['breadcrumbs'][] = ['label' => 'Especialistas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view" align="center">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'apellido',
            'nombreUsuario',
            'email:email',
            [
                'attribute'=>'activo',
                'value'=>$model->activo == 1 ? 'Si' : 'No'
            ],

            [
                'attribute'=>'assignedAquariumsNames',
                'label'=>'Aquarios asignados',
                'value'=>function($model){
                    $aquariums = [];
                    foreach ($model->assignedAquariumsNames as $key => $value) {
                        $aquariums[] = $value;
                    }
                    return implode(', ',$aquariums);
                }

            ]

        ],
    ]) ?>
<br>
<div class="form-group" align="center">
        <?= Html::button(FA::icon('remove')->size(FA::SIZE_LARGE).' Cancelar',['class' => 'btn btn-danger','data-dismiss'=>'modal']) ?>
    </div>
</div>
