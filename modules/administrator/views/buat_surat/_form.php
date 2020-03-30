<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\DataSiswa */
/* @var $form yii\widgets\ActiveForm */

$template=['template'=>'<div class="form-group form-float">
                            <div class="form-line">
                                {input}
                                <label class="form-label">{label}</label>
                            </div>
                            {error}
                            <div class="help-info">{hint}</div>
                        </div>'];

$template_ddl=['template'=>'<div class="form-group form-float">
                                <label class="form-label costum-label">{label}</label>
                            <div class="form-line">
                                {input}
                            </div>
                            {error}
                            <div class="help-info">{hint}</div>
                        </div>'];

$template_ddl_ajax=['template'=>'<div class="form-group form-float">
                                <label class="form-label costum-label">{label}</label>
                            <div class="form-line" id="uid_sekolah">
                                {input}
                            </div>
                            {error}
                            <div class="help-info">{hint}</div>
                        </div>'];

$template_ddl_ajax2=['template'=>'<div class="form-group form-float">
                                <label class="form-label costum-label">{label}</label>
                            <div class="form-line" id="uid_jenis_surat">
                                {input}
                            </div>
                            {error}
                            <div class="help-info">{hint}</div>
                        </div>'];

?>

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
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another action</a></li>
                            <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="staf-buat-surat-form">

                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'sekolah', $template_ddl)->dropDownList($sekolah, ['prompt' => '--pilih sekolah--', 'class'=>'form-control show-tick']) ?>

                    <?= $form->field($model, 'uid_jenis_surat', $template_ddl_ajax2)->dropDownList([NULL],['prompt' => '--pilih salah satu--', 'name'=>'StafBuatSurat[uid_jenis_surat]']) ?>

                    <?= $form->field($model, 'uid_data_siswa', $template_ddl_ajax)->dropDownList([NULL=>'--pilih sekolah dulu--'],['id'=>'ajax-select', 'class'=>'form-control selectpicker with-ajax show-tick', 'data-live-search'=>'true']) ?>

                    <?= $form->field($model, 'estimasi_selesai_tanggal', $template_ddl_ajax)->textInput(['class'=>'datepicker form-control']) ?>

                    <?= $form->field($model, 'biaya_optional', $template_ddl_ajax)->textInput() ?>

                    <!--?= $form->field($model, 'attribute_tambahan_optional', $template)->textarea(['rows' => 6]) ?-->

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
$homeUrl=Yii::$app->homeUrl;
$csrf=Yii::$app->request->getCsrfToken();
$jenisSurat=$model->uid_jenis_surat;
$status= $model->isNewRecord?1:0;
$js=<<< JAVASCRIPT

$('document').ready(function(){

    var id_sekolah= $('#stafbuatsurat-sekolah').val();
    $('#stafbuatsurat-sekolah').change(function(){
        id=$(this).val();
        var id_sekolah= $('#stafbuatsurat-sekolah').val();
        
            $('.selectpicker').selectpicker().filter('.with-ajax').ajaxSelectPicker({
                    ajax          : {
                        url     : '$homeUrl\administrator/buat_surat/get_siswa_json',
                        type    : 'POST',
                        dataType: 'json',
                        // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
                        // automatically replace it with the value of the search query.
                        data    : {
                            q: '{{{q}}}',
                            uid_sekolah: $(this).val(),
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
                                    text : data[i].nama_siswa,
                                    value: data[i].uid_siswa,
                                    data : {
                                        subtext: data[i].nis_siswa
                                    }
                                }));
                            }
                        }
                        // You must always return a valid array when processing data. The
                        // data argument passed is a clone and cannot be modified directly.
                        return array;
                    }
                });
        
        $.ajax({
              url: '$homeUrl\administrator/buat_surat/get_jenis_surat',
              data: 'id='+id+'&_csrf=$csrf',
              type: 'POST',
              success:function(data){
                   $('#uid_jenis_surat').html(data);
                   $('#stafbuatsurat-uid_jenis_surat').selectpicker();
                   
                   $('#stafbuatsurat-uid_jenis_surat').change(function(){
                        id=$(this).val();
                        $.ajax({
                              url: '$homeUrl\administrator/buat_surat/get_info_json',
                              data: 'id='+id+'&_csrf=$csrf',
                              type: 'POST',
                              dataType: 'json',
                              success:function(data){
                                  //using moment js
                                  $('#stafbuatsurat-estimasi_selesai_tanggal').val(data.estimasi_selesai);
                                  $('#stafbuatsurat-biaya_optional').val(data.biaya);
                                  
                              },
                              error: function(){
                                    swal('oups... error');
                              }
                          });
                    });
                   
                   
              },
              error: function(){
                    swal('oups... error');
              }
          });
    });
    
    $('#stafbuatsurat-uid_jenis_surat').change(function(){
        id=$(this).val();
        $.ajax({
              url: '$homeUrl\administrator/buat_surat/get_jenis_surat',
              data: 'id='+id+'&_csrf=$csrf',
              type: 'POST',
              success:function(data){
                   $('#uid_jenis_surat').html(data);
                   $('#stafbuatsurat-uid_jenis_surat').selectpicker();
              },
              error: function(){
                    swal('oups... error');
              }
          });
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
                    //if update and document has been load fully
                    $.ajax({
                      url: '$homeUrl\administrator/buat_surat/get_jenis_surat',
                      data: 'id='+$('#stafbuatsurat-sekolah').val()+'&_csrf=$csrf',
                      type: 'POST',
                      success:function(data){
                           $('#uid_jenis_surat').html(data);
                           $('#stafbuatsurat-uid_jenis_surat').val('$jenisSurat');
                           $('#stafbuatsurat-uid_jenis_surat').selectpicker();
                      }
                      });
                
                    $.ajax({
                      url: '$homeUrl\administrator/buat_surat/get_data_siswa_json',
                      data: 'id='+'$model->uid_data_siswa'+'&_csrf=$csrf',
                      type: 'POST',
                      dataType: 'json',
                      success:function(data){
                           $('#ajax-select').append('<option value="'+data[0].uid_siswa+'" data-subtext="'+data[0].nis_siswa+'" selected="selected">'+data[0].nama_siswa+'</option>').selectpicker('refresh');
                      }
                      });
                }
            
});
JAVASCRIPT;
$this->registerJS($js);
?>