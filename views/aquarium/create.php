<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Aquarium */

$this->title = 'Create Aquarium';
$this->params['breadcrumbs'][] = ['label' => 'Aquaria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aquarium-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
