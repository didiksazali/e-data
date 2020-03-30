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

$template_ddl=['template'=>'<div class="form-group form-float">
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
    select{

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

                <div class="dm-jabatan-form">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'kode_jabatan', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'nama_jabatan', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'deskripsi_jabatan', $template)->textInput(['maxlength' => true]) ?>

                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn bg-cyan btn-block btn-lg waves-effect' : 'btn bg-red btn-block btn-lg waves-effect']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>

            </div>

        </div>
    </div>
</div>
</div>
<!-- #END# Advanced Form Example With Validation -->

<?php
$homeUrl=Yii::$app->homeUrl;
$csrf=Yii::$app->request->getCsrfToken();
$js=<<< JAVASCRIPT
    
    function createHtml(count){
        return '<div class="input-group input-group-lg">'+
                    '<span class="input-group-addon">'+
                                           '<span class="fa fa-trash"></span>'+
                                    '</span>'+
                                    '<div class="form-line">'+
                                        '<input type="text" class="form-control" name="value['+count+']">'+
                                    '</div>'+
                                    '<span class="input-group-addon">'+
                                            '<input type="checkbox" class="filled-in" id="ig_checkbox">'+
                                            '<label for="ig_checkbox">GARIS BARU</label>'+
                                    '</span>'+
                                '</div>';
    }
    
    $('document').ready(function(){
        var count=0;
        $('#stafjenissurat-help_sekolah').change(function(){
            id=$(this).val();
            $.ajax({
              url: '$homeUrl\administrator/jenis_surat/get_template',
              data: 'id='+id+'&_csrf=$csrf',
              type: 'POST',
              success:function(data){
                   $('#uid_sekolah').html(data);
                   $('#stafjenissurat-uid_template_surat').selectpicker();
              },
              error: function(){
                    swal('oups... error');
              }
          });
        });
    
        
        $('#check_attr_add').click(function(){
            if($(this).is(':checked')){
                $('#attr_add_body').show('slow');
                $('#tbh').click(function(){
                    count++;
                    var html= $('#attr_add').html();
                    $('#attr_add').html(html+createHtml(count));
                    
                });
            }
            else{
                $('#attr_add_body').hide('slow');
            }
        });
        
    });
JAVASCRIPT;
$this->registerJS($js);
?>
