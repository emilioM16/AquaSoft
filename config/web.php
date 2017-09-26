<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules'=>[
        'admin'=>[
            'layout'=>'left-menu',
            'class'=>'mdm\admin\Module',
            'controllerMap'=>[
                'assignment'=>[
                    'class'=>'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'app\models\User',
                    'idField'=>'id_usuario',
                    'usernameField' => 'nombre_usuario',
                    'searchClass'=>'app\models\UserSearch',
                ],
            ],
        ]
    ],
    'components' => [
        'authManager'=>[
            'class'=>'yii\rbac\DbManager',
            'defaultRoles'=>['guest'],
        ],
        // 'assetManager' => [
        //         'bundles' => [
        //             'yii\bootstrap\BootstrapAsset' => [
        //                 'depends' => [                  
        //                     'yii\jui\JuiAsset',
        //                 ],
        //             ],
        //         ],
        //     ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '7okQHtT7b1E0btykD3V7mVEiaZBx2A3i',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'loginUrl'=> ['site/login'],
            'enableAutoLogin' => true,
            'enableSession'=>true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login'=>'site/login',
                'logout'=>'site/logout',
            ],
        ],
    ],
    'as access'=>[ //importante para conceder acceso!
        'class'=>'mdm\admin\components\AccessControl',
        'allowActions'=>['*']
    ],
    'params' => $params,
    'defaultRoute'=>'site/index',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;

