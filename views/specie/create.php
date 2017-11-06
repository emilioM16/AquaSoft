<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\specie\Specie */

$this->title = 'Agregar especie';
$this->params['breadcrumbs'][] = ['label' => 'Especies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specie-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
