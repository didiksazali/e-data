<?php

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
<style>
    .auth_bg{
        background-color: #00a5bb;
        max-height: 400px ;
        color: #fafafa;
    }
    ul.auth_assignment{
        list-style-type: none;
    }
    ul.lvl1{
        margin: 0px;
        padding: 10px;
    }
    ul.lvl2{
        margin: 0px;
        padding: 0 0 0 35px;
    }
    ul.lvl3{
        margin: 0px;
        padding: 0 0 0 35px;
    }
</style>
<div class="container-fluid">
    <div class="row clearfix">
        <!-- Color Variations -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ATUR PERAN
                    </h2>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-4">

                            <div class="switch">
                                <label>ATUR PER USER <input type="checkbox" checked=""><span class="lever switch-col-blue"></span> ATUR PER ROLE</label>
                            </div>
                            <br/>
                            <select class="form-control show-tick" data-live-search="true" id="getParentId">
                                <option value="">-- Please select --</option>
                            </select>
<?php print_r($item);?>
                        </div>
                        <div class="col-md-8">
                            <div class="demo-checkbox auth_bg">
                                <ul class="auth_assignment lvl1">
                                    <?php
                                        foreach ($item as $key=> $value){
                                            ?>
                                            <li>
                                                <input type="checkbox" id="md_checkbox_<?= $value['id']; ?>" class="filled-in chk-col-red" checked="">
                                                <label for="md_checkbox_<?= $value['id']; ?>"><?= $value['router'] ?></label>
                                                <?php
                                                    if(array_key_exists('child', $value)){
                                                        ?>
                                                            <ul class="auth_assignment lvl2">
                                                        <?php
                                                            foreach ($value['child'] as $keys => $values ){
                                                            ?>
                                                                <li>
                                                                    <input type="checkbox" id="md_checkbox_<?= $values['id']; ?>" class="filled-in chk-col-red" checked="">
                                                                    <label for="md_checkbox_<?= $values['id']; ?>"><?= $values['router'] ?></label>
                                                                </li>
                                                            <?php
                                                                if(array_key_exists('child', $values)){
                                                                ?>
                                                                    <ul class="auth_assignment lvl3">
                                                                        <?php
                                                                            foreach ($values['child'] as $keyz=> $valuez){
                                                                                ?>
                                                                                <li>
                                                                                    <input type="checkbox" id="md_checkbox_<?= $valuez['id']; ?>" class="filled-in chk-col-red" checked="">
                                                                                    <label for="md_checkbox_<?= $valuez['id']; ?>"><?= $valuez['router'] ?></label>
                                                                                </li>
                                                                                <?php
                                                                            }
                                                                        ?>
                                                                    </ul>
                                                                <?php
                                                                }
                                                            }
                                                            ?>
                                                            </ul>
                                                        <?php
                                                    }
                                                ?>
                                            </li>
                                            <?php
                                        }
                                    ?>
                                </ul>
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
