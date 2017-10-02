<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Aquarium */

$this->title = 'Agregar acuario';
$this->params['breadcrumbs'][] = ['label' => 'Acuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aquarium-create">

    <?php 
        Yii::$app->session->set('modalTitle',$this->title);
        echo $this->render('_form', [
        'model' => $model,
        ]) 
    ?>

</div>
