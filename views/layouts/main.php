<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use rmrevin\yii\fontawesome\FA;
use kartik\popover\PopoverX;

AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
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

<div class="wrap">
    <?php

    $notifications = 

        '<div class="alert text-justify " role="alert">
        '. FA::icon("info")->size(FA::SIZE_LARGE).'  Se ha registrado una <strong>nueva planificación</strong> para el acuario A01 
        </div>
        <hr class="hrNotif">
        <div class="alert text-justify" role="alert">
        '. FA::icon("warning")->size(FA::SIZE_LARGE).' <strong>¡Peligro!</strong> Las condiciones ambientales  del acuario AS03 se encuentran fuera de los umbrales.
        </div>
        <hr class="hrNotif">
        <div class="alert" role="alert">
            ...
        </div>
        <hr class="hrNotif">
        <div class="alert " role="alert">
            ...
        </div>
        <hr class="hrNotif">
        <div class="alert text-justify" role="alert">
        '. FA::icon("warning")->size(FA::SIZE_LARGE).' <strong>¡Peligro!</strong> Las condiciones ambientales del acuario AS03 se encuentran fuera de los umbrales.
        </div>
        <hr class="hrNotif">
        <div class="alert " role="alert">
            ...
        </div>
        <hr class="hrNotif">
        <div class="alert " role="alert">
          ...
        </div>';

    NavBar::begin([
        'brandLabel' => Html::img('@web/img/logoPez.png'),
        'brandUrl' => null,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top text-center',
        ],
    ]);
    echo Nav::widget([
        'encodeLabels'=>false,
        'options' => ['class'=>'navbar-nav navbar-left'],
        'items'=>[
            ['label'=>FA::icon('cubes')->size(FA::SIZE_LARGE),
                'url'=>['acuarium/'],
                'options'=>[
                    'data-toggle'=>'tooltip',
                    'data-placement'=>'bottom',
                    'title'=>'Acuarios'
                ]
            ],

            ['label'=>FA::icon('calendar')->size(FA::SIZE_LARGE),
                'url'=>['planification/'],
                'options'=>[
                    'data-toggle'=>'tooltip',
                    'data-placement'=>'bottom',
                    'title'=>'Planificaciones'
                ]
            ],
            

            //SOLO PARA ESPECIALISTA
            ['label'=>file_get_contents("img/fishIcon4.svg"),
                'url'=>['specimen/'],
                'visible'=>Yii::$app->session->get('user.role') == 'especialista' || Yii::$app->session->get('user.role') == 'administrador',
                'options'=>[
                    'data-toggle'=>'tooltip',
                    'data-placement'=>'bottom',
                    'title'=>'Ejemplares',
                ],
                'linkOptions'=>[
                    'class'=>'iconAnchor',
                ]
            ],

            ['label'=>file_get_contents("img/fishes.svg"),
                'url'=>['species/'],
                'visible'=>Yii::$app->session->get('user.role') == 'especialista' || Yii::$app->session->get('user.role') == 'administrador',
                'options'=>[
                    'data-toggle'=>'tooltip',
                    'data-placement'=>'bottom',
                    'title'=>'Especies',
                ],
                'linkOptions'=>[
                    'class'=>'iconAnchor',
                ]
            ],

            ///////////////////////////////

            ['label'=>FA::icon('users')->size(FA::SIZE_LARGE),
                'url'=>['user/'],
                'visible'=>Yii::$app->session->get('user.role') == 'encargado' || Yii::$app->session->get('user.role') == 'administrador',
                'options'=>[
                    'data-toggle'=>'tooltip',
                    'data-placement'=>'bottom',
                    'title'=>'Especialistas'
                ]
            ],

            ['label'=>FA::icon('archive')->size(FA::SIZE_LARGE),
                'url'=>['supply/'],
                'visible'=>Yii::$app->session->get('user.role') == 'encargado' || Yii::$app->session->get('user.role') == 'administrador',
                'options'=>[
                    'data-toggle'=>'tooltip',
                    'data-placement'=>'bottom',
                    'title'=>'Insumos'
                ]
            ],

            ['label'=>FA::icon('bar-chart')->size(FA::SIZE_LARGE),
            'url'=>['census/'],
                'options'=>[
                    'data-toggle'=>'tooltip',
                    'data-placement'=>'bottom',
                    'title'=>'Censos'
                ]
            ],
    ]]);
    echo Nav::widget([
        'encodeLabels'=>false,
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label'=>FA::icon('home')->size(FA::SIZE_LARGE), 
                'url'=>[Yii::$app->homeUrl],
                'options'=>[
                    'data-toggle'=>'tooltip',
                    'data-placement'=>'bottom',
                    'title'=>'Ir al inicio'
                ]
            ],

            ['label'=>
                PopoverX::widget([
                    'header' => 'Notificaciones',
                    'placement' => PopoverX::ALIGN_BOTTOM,
                    'content' => $notifications,
                    'options'=>[
                        'class'=>'popover-notif'
                    ],
                    'toggleButton' => 
                        [
                            'tag'=>'div',
                            'label'=>FA::icon('bell')->size(FA::SIZE_LARGE),'class'=>'nav-link '
                        ],
                ]), 
            'url'=>null,
            'options'=>[
                'id'=>'notificationButton',
                'data-toggle'=>'tooltip',
                'data-placement'=>'bottom',
                'title'=>'Notificaciones',
                ]
            ],
            


            ['label'=>FA::icon('user')->size(FA::SIZE_LARGE).' '.Yii::$app->user->identity->apellido.', '. Yii::$app->user->identity->nombre,
                'url'=>null,
            ],

            ['label'=>FA::icon('question-circle')->size(FA::SIZE_LARGE), 
            'url'=>['site/help'],
            'options'=>[
                'data-toggle'=>'tooltip',
                'data-placement'=>'bottom',
                'title'=>'Ayuda'
                ]
            ],


            
            ['label'=>FA::icon('power-off')->size(FA::SIZE_LARGE), 
                'url'=>['site/logout'],
                'linkOptions'=>[
                    'data-method'=>'post',
                ],
                'options'=>[
                    'data-toggle'=>'tooltip',
                    'data-placement'=>'bottom',
                    'title'=>'Cerrar sesión',
                    'class'=>'verticalDivider',
                    ]
            ],
        ],
    ]);
    NavBar::end();
    ?>
    
    <div class="container col-lg-12">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <div class="col-lg-12">
        <?= $content ?>
        </div>
    </div>
</div>
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>