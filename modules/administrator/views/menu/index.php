
<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\SidebarNewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atur Menu';
$this->params['breadcrumbs'][] = $this->title;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\SidebarNews */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="container-fluid">
    <div class="row clearfix">
        <!-- Color Variations -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        EDIT MENU UTAMA
                    </h2>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Edit item</div>
                                <div class="panel-body">
                                    <form id="frmEdit" class="form-horizontal">
                                        <input type="hidden" name="mnu_icon" id="mnu_icon">
                                        <div class="form-group">
                                            <label for="mnu_text" class="col-sm-2 control-label">Text</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="mnu_text" name="mnu_text" placeholder="Text">
                                                    <div class="input-group-btn">
                                                        <button id="mnu_iconpicker" class="btn btn-default" data-iconset="fontawesome" data-icon="" type="button"></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="mnu_href" class="col-sm-2 control-label">URL</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="mnu_href" name="mnu_href" placeholder="URL">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="mnu_target" class="col-sm-2 control-label">Target</label>
                                            <div class="col-sm-10">
                                                <select id="mnu_target" name="mnu_target" class="form-control">
                                                    <option value="_self">Self</option>
                                                    <option value="_blank">Blank</option>
                                                    <option value="_top">Top</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="mnu_title" class="col-sm-2 control-label">Tooltip</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="mnu_title" name="mnu_title" placeholder="Text">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="panel-footer">
                                    <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fa fa-refresh"></i> Update</button>
                                    <button type="button" id="btnAdd" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading clearfix"><h5 class="pull-left">Menu</h5>
                                    <div class="pull-right">
                                        <button id="btnReload" type="button" class="btn btn-default">
                                            <i class="glyphicon glyphicon-triangle-right"></i> Load Data</button>

                                    </div>
                                </div>
                                <div class="panel-body" id="cont">
                                    <ul id="myList" class="sortableLists list-group">
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group">
                                <button id="btnOut" type="button" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Output</button>
                            </div>
                            <div class="form-group"><textarea id="out" class="form-control" cols="50" rows="10"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<< JS
    jQuery(document).ready(function () {
        var strjson = '[{"href":"http://home.com","icon":"fa fa-home","text":"Home"},{"icon":"fa fa-bar-chart-o","text":"Opcion2"},{"icon":"fa fa-cloud-upload","text":"Opcion3"},{"icon":"fa fa-crop","text":"Opcion4"},{"icon":"fa fa-flask","text":"Opcion5"},{"icon":"fa fa-search","text":"Opcion7","children":[{"icon":"fa fa-plug","text":"Opcion7-1","children":[{"icon":"fa fa-filter","text":"Opcion7-2","children":[{"icon":"fa fa-map-marker","text":"Opcion6"}]}]}]}]';
        var iconPickerOpt = {cols: 5, searchText: "Buscar...", labelHeader: '{0} de {1} Pags.', footer: false};
        var options = {
        hintCss: {'border': '1px dashed #13981D'},
        placeholderCss: {'background-color': 'gray'},
        ignoreClass: 'btn',
        opener: {
        active: true,
        as: 'html',
        close: '<i class="fa fa-minus"></i>',
        open: '<i class="fa fa-plus"></i>',
        openerCss: {'margin-right': '10px'},
        openerClass: 'btn btn-success btn-xs'
        }
        };
        var editor = new MenuEditor('myList', {listOptions: options, iconPicker: iconPickerOpt, labelEdit: 'Edit', labelRemove: 'Remove'});
        $('#btnReload').on('click', function () {
        editor.setData(strjson);
        });
        $('#btnOut').on('click', function () {
        var str = editor.getString();
        $("#out").text(str);
        });
        editor.setData(strjson);
    });
JS;
$this->registerJs($js);
?>
