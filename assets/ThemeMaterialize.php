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
class ThemeMaterialize extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'materialize-theme/assets/css/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
        'materialize-theme/assets/img/apple-icon.png',
        'materialize-theme/assets/img/favicon.png',
        'materialize-theme/assets/css/bootstrap.min.css',
        'materialize-theme/assets/css/material-dashboard.css',
        'materialize-theme/assets/css/demo.css',
        'http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css',
        'http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons',
    ];
    public $js = [
  'materialize-theme/assets/plugins/momentjs/moment.js',
  'materialize-theme/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
  'materialize-theme/assets/js/jquery-3.1.0.min.js',
	'materialize-theme/assets/js/bootstrap.min.js',
	'materialize-theme/assets/js/material.min.js',
	'materialize-theme/assets/js/chartist.min.js',
	'materialize-theme/assets/js/bootstrap-notify.js',
	'https://maps.googleapis.com/maps/api/js',
	'materialize-theme/assets/js/material-dashboard.js',
	'materialize-theme/assets/js/demo.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
