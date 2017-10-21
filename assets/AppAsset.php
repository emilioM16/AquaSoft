<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/login.css',
        'css/aquariums.css',
        'css/planning.css',
        'css/specimens.css',
    ];
    public $js = [
        'js/aquariums.js',
        'js/site.js',
        'js/planning.js',
        'js/specialists.js',
        'js/tasks.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        '\delocker\animate\AnimateAssetBundle',
        'app\assets\SweetAlertAsset',
    ];
}
