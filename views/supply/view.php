<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\supply\Supply */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Insumos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supply-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <br><br>
        <div class="col-lg-10 form-left">


        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [

            'nombre',
            'descripcion',
            'stock',
            'TIPO_TAREA_idTipoTarea',
            ],
        ]) ?>
        <br><br>

        <?php

        echo '<div>'
       .Html::a('Volver al inicio', ['supply/index'], [
                'class' => 'btn btn-primary',
                'data' => [
                    'method' => 'post',
                  ],
            ]).
          '</div>';

        ?>

    </div>


    </div>
</div>
