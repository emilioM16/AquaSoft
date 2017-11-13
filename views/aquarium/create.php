<?php

use yii\helpers\Html;
use kartik\switchinput\SwitchInputAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Aquarium */
SwitchInputAsset::register($this); 
$this->title = 'Agregar acuario';
$this->params['breadcrumbs'][] = ['label' => 'Acuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aquarium-create">

    <?php 
        echo $this->render('_form', [
        'model' => $model,
        ]) 
    ?>

</div>
