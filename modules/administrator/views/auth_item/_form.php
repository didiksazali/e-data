<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\SidebarNewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atur Menu';
$this->params['breadcrumbs'][] = $this->title;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\SidebarNews */
/* @var $form yii\widgets\ActiveForm */
$template= ['template'=>'<div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control">
                                    <label class="form-label">{label}</label>
                                </div>
                                {error}
                            </div>'];
?>
<div class="container-fluid">
    <div class="row clearfix">
        <!-- Color Variations -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        CREATE/ UPDATE AUTH ITEM
                    </h2>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-12">

                            <?php $form = ActiveForm::begin(); ?>

                            <?= $form->field($model, 'name', $template)->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'type')->dropDownList([1=>'Role', 2=>'Modules',3=>'controller',4=>'action'], ['prompt'=>'--Pilih Satu--']) ?>

                            <?= $form->field($model, 'parrent_id')->textInput() ?>

                            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                            <?= $form->field($model, 'rule_name', $template)->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'data')->textInput() ?>

                            <div class="form-group">
                                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>

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
