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
class ThemeAwesome extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
   // 'css/site.css',
        'add-on/buttons/css/buttons.css',
        'add-on/sweetalert2/dist/sweetalert2.min.css',
        'awesome-theme/pluginsplugins/animate-css/animate.css',
        'https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext',
        'https://fonts.googleapis.com/icon?family=Material+Icons',
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css',

        'add-on/drag_menu/bs-iconpicker/css/bootstrap-iconpicker.min.css',
        'awesome-theme/plugins/bootstrap/css/bootstrap.css',
        'awesome-theme/plugins/node-waves/waves.css',
        'awesome-theme/plugins/animate-css/animate.css',
        'awesome-theme/plugins/morrisjs/morris.css',
        'awesome-theme/css/style.css',
        'awesome-theme/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
        'awesome-theme/plugins/waitme/waitMe.css',
        'awesome-theme/plugins/bootstrap-select/css/bootstrap-select.css',
        'awesome-theme/css/themes/all-themes.css',
        'add-on/ajax_select/dist/css/ajax-bootstrap-select.css',
    ];
    public $js = [
        'add-on/buttons/js/buttons.js',
        'add-on/sweetalert2/dist/sweetalert2.min.js',
        'awesome-theme/js/pages/ui/dialogs.js',
        'awesome-theme/plugins/bootstrap/js/bootstrap.js',
        'awesome-theme/plugins/bootstrap-select/js/bootstrap-select.js',
        'awesome-theme/plugins/jquery-slimscroll/jquery.slimscroll.js',
        'awesome-theme/plugins/node-waves/waves.js',
        /////////////////////////////////////////////////////////
        'awesome-theme/plugins/jquery-countto/jquery.countTo.js',
        'awesome-theme/plugins/raphael/raphael.min.js',
        'awesome-theme/plugins/morrisjs/morris.js',
        'awesome-theme/plugins/chartjs/Chart.bundle.js',
        'awesome-theme/plugins/flot-charts/jquery.flot.js',
        'awesome-theme/plugins/flot-charts/jquery.flot.resize.js',
        'awesome-theme/plugins/flot-charts/jquery.flot.pie.js',
        'awesome-theme/plugins/flot-charts/jquery.flot.categories.js',
        'awesome-theme/plugins/flot-charts/jquery.flot.time.js',
        'awesome-theme/plugins/jquery-sparkline/jquery.sparkline.js',
        'awesome-theme/plugins/momentjs/moment.js',
        'awesome-theme/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepickers.js',
        'awesome-theme/plugins/momentjs/moment.js',
        'awesome-theme/plugins/autosize/autosize.js',
        'awesome-theme/js/pages/forms/form-wizard.js',
        'awesome-theme/plugins/jquery-steps/jquery.steps.js',
        'awesome-theme/plugins/jquery-validation/jquery.validate.js',
        'awesome-theme/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js',
        //'awesome-theme/js/pages/forms/basic-form-elements.js',
        'https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js',
        'https://oss.maxcdn.com/respond/1.4.2/respond.min.js',
        'add-on/drag_menu/jquery-menu-editor.js?v2',
        'add-on/drag_menu/bs-iconpicker/js/iconset/iconset-fontawesome-4.2.0.min.js',
        'add-on/drag_menu/bs-iconpicker/js/bootstrap-iconpicker.js?v2',
        'add-on/ajax_select/dist/js/ajax-bootstrap-select.js',
        'awesome-theme/plugins/chartjs/Chart.bundle.js',
        'awesome-theme/js/admin.js',

//        'awesome-theme/js/pages/charts/chartjs.js',
        'awesome-theme/js/demo.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}



	
