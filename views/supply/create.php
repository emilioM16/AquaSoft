<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\supply\Supply */

$this->title = 'Agregar insumo';
$this->params['breadcrumbs'][] = ['label' => 'Insumos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supply-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
