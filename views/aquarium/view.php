<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FA;
use kartik\form\ActiveForm;
use kartik\builder\Form;
/* @var $this yii\web\View */
/* @var $model app\models\Aquarium */

$this->title = $model->idacuario;
$this->params['breadcrumbs'][] = ['label' => 'Aquaria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aquarium-view">

    
    <!-- <?php
        $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL, 'formConfig'=>['labelSpan'=>1]]);
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'staticOnly'=>true,
            'columns'=>4,
            'attributes'=>[
                'nombre'=>['labelSpan'=>1],
                'espaciodisponible'=>[],
                'capacidad_maxima'=>[],
                'espaciodisponible'=>[],
                'activo'=>[]
            ]
        ]);

        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'staticOnly'=>true,
            'columns'=>1,
            'attributes'=>[
                'descripcion'=>[],
            ]
        ]);
        ActiveForm::end();
    ?> -->

    <div align="center">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idacuario',
            'nombre',
            'descripcion',
            'capacidad_maxima',
            'espaciodisponible',
            'activo',
        ],
        'class'=>['form-center']
    ]) ?>
    </div>
<br>
<div class="form-group" align="center">
        <?= Html::button(FA::icon('remove')->size(FA::SIZE_LARGE).' Cancelar',['class' => 'btn btn-danger','data-dismiss'=>'modal']) ?>
    </div>
</div>
