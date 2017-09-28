<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\Carousel;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <!-- <div>
        <?php        
        echo Carousel::widget([
            'id'=>'background-carousel',
            'items' => [
                // the item contains only the image
                '<div class="item active" style="background-image:url(/img/fondo1.jpg)"></div>',
                '<div class="item active" style="background-image:url(/img/fondo2.jpg)"></div>',
                // equivalent to the above
            ],
            'showIndicators'=>false,
            'options'=>[
                'class'=>'carousel carousel-fade'
            ],
        ]);
        ?>
    </div> -->
        
    <div id="background-carousel" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
                <div class="item active" style="background-image:url(/img/fondo1.jpg)"></div>
                <div class="item" style="background-image:url(/img/fondo2.jpg)"></div>
        </div>
    </div>


<div class="wrap">

    <div class="container">
        <?= $content ?>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
