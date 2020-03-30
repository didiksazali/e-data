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
class ThemePartial extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext',
        'https://fonts.googleapis.com/icon?family=Material+Icons',
        'awesome-theme/plugins/bootstrap/css/bootstrap.css',
        'awesome-theme/plugins/node-waves/waves.css',
        'awesome-theme/css/style.css',

    ];
    public $js = [
        'awesome-theme/plugins/jquery/jquery.min.js',
        'awesome-theme/plugins/bootstrap/js/bootstrap.js',
        'awesome-theme/plugins/node-waves/waves.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}





