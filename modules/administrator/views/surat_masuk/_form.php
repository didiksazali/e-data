<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\DataSiswa */
/* @var $form yii\widgets\ActiveForm */

$template=['template'=>'<div class="form-group form-float">
                            <div class="form-line">
                                {input}
                                <label class="form-label costum-label">{label}</label>
                            </div>
                            {error}
                            <div class="help-info">{hint}</div>
                        </div>'];
$template_date=['template'=>'<div class="form-group form-float">
                                <label class="form-label costum-label">{label}</label>
                            <div class="form-line">
                                {input}
                            </div>
                            {error}
                            <div class="help-info">{hint}</div>
                        </div>'];

?>

<style>
    .costum-form{
        padding-bottom: 10px;
    }
    .costum-label{
        color: #aaa;
    }
</style>
<!-- Advanced Form Example With Validation -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2><?= strtoupper(Html::encode($this->title)); ?></h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Reload</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <?php if (Yii::$app->session->hasFlash('create_unsuccess')): ?>
                    <div class="alert bg-pink alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <?= Yii::$app->session->getFlash('create_unsuccess') ?>
                    </div>
                <?php endif; ?>

                <div class="staf-surat-masuk-form">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'no_surat', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'tanggal_masuk', $template_date)->textInput(['maxlength' => true, 'class'=>'datepicker form-control', 'value'=>date('Y-m-d')]) ?>

                    <?= $form->field($model, 'dari', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'tujuan_surat_kesekolah')->dropDownList($sekolah, ['prompt'=>'--Pilih Satu--', 'class'=>'form-control show-tick']) ?>

                    <?= $form->field($model, 'maksud_surat', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'uid_kategori_surat')->dropDownList($kategori_surat, ['prompt'=>'--Pilih Satu--', 'class'=>'form-control show-tick']) ?>

                    <?= $form->field($model, 'document_scan')->fileInput() ?>

                    <?= $form->field($model, 'tags_surat', $template)->textInput()->hint('pisahkan dengan koma') ?>


                    <div class="demo-checkbox">
                        <input type="checkbox" id="tindakanLanjut" class="filled-in chk-col-red" name="check_helper" value="0" <?= $model->tindakan_yang_harus_dilakukan!=''?'checked':'' ?>>
                        <label for="tindakanLanjut">ADA TINDAKAN LANJUT</label>
                    </div>

                    <div id="tindakanTambahan" style="<?= $model->tindakan_yang_harus_dilakukan==''?'display:none':''?>; margin-top: 12px";>
                        <?= $form->field($model, 'tindakan_yang_harus_dilakukan', $template)->textarea(['rows' => 6]) ?>

                        <?= $form->field($model, 'estimasi_batas_tindakan', $template_date)->textInput(['maxlength' => true, 'class'=>'datepicker form-control', 'value'=>$model->isNewRecord?(date('Y-m-d',strtotime("+3 day"))):$model->estimasi_batas_tindakan]) ?>

                        <?= $form->field($model, 'beban_kerja_kepada')->dropDownList([''=>'--ketik beberapa karakter dulu--'],['prompt'=>'--pilih salah satu--','id'=>'ajax-select', 'class'=>'form-control selectpicker with-ajax show-tick', 'data-live-search'=>'true']) ?>

                    </div>

                    <br/>

                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn bg-cyan btn-block btn-lg waves-effect' : 'btn bg-red btn-block btn-lg waves-effect']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- #END# Advanced Form Example With Validation -->

<?php
$status= $model->isNewRecord?1:0;
$staf= $model->beban_kerja_kepada;
$homeUrl=Yii::$app->homeUrl;
$csrf=Yii::$app->request->getCsrfToken();
$js=<<< JAVASCRIPT
    $('document').ready(function(){
    
                var options = {
        ajax          : {
            url     : '$homeUrl\administrator/surat_masuk/get_staf_json',
            type    : 'POST',
            dataType: 'json',
            // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
            // automatically replace it with the value of the search query.
            data    : {
                q: '{{{q}}}'
            }
        },
        locale        : {
            emptyTitle: 'Select and Begin Typing'
        },
        log           : 3,
        preprocessData: function (data) {
            var i, l = data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data[i], {
                        text : data[i].nama_staf,
                        value: data[i].uid_staf,
                        data : {
                            subtext: data[i].nip_staf
                        }
                    }));
                }
            }
            // You must always return a valid array when processing data. The
            // data argument passed is a clone and cannot be modified directly.
            return array;
        }
    };

    $('.selectpicker').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);
    $('select.after-init').append('<option value="neque.venenatis.lacus@neque.com" data-subtext="neque.venenatis.lacus@neque.com" selected="selected">Chancellor</option>').selectpicker('refresh');
    $('select').trigger('change');
    
    
            $('#tindakanLanjut').click(function(){
                if($(this).is(':checked')){
                    $(this).val("1");
                    $('#tindakanTambahan').show('slow');
                }
                else{
                    $(this).val("0");
                    $('#tindakanTambahan').hide('slow');
                }
            });
            
    
            //Textare auto growth
            autosize($('textarea.auto-growth'));
        
            //Datetimepicker plugin
            //$('.datetimepicker').bootstrapMaterialDatePicker({
            //    format: 'dddd DD MMMM YYYY - HH:mm',
            //    clearButton: false,
            //    weekStart: 1
            //});
        
            $('.datepicker').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD',
                clearButton: true,
                weekStart: 1,
                time: false
            });
        
            $('.timepicker').bootstrapMaterialDatePicker({
                format: 'HH:mm',
                clearButton: true,
                date: false
            });
            
            if('$status'==0){
                $.ajax({
                      url: '$homeUrl\administrator/surat_masuk/get_data_staf_json',
                      data: 'id='+'$staf'+'&_csrf=$csrf',
                      type: 'POST',
                      dataType: 'json',
                      success:function(data){
                           $('#ajax-select').append('<option value="'+data[0].uid_staf+'" data-subtext="'+data[0].nip_staf+'" selected="selected">'+data[0].nama_staf+'</option>').selectpicker('refresh');
                      }
                      });
            }
    });
JAVASCRIPT;
$this->registerJS($js);
?>

