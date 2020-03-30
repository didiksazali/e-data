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

$template_ddl_ajax2=['template'=>'<div class="form-group form-float">
                                <label class="form-label costum-label">{label}</label>
                            <div class="form-line" id="uid_kelas">
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

                <div class="data-siswa-form">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                    <?= $form->field($model, 'sekolah', $template_ddl)->dropDownList($sekolah, ['prompt' => '--pilih salah satu--']) ?>

                    <?= $form->field($model, 'kelas', $template_ddl_ajax2)->dropDownList($model->isNewRecord?[NULL]:$kelas,['prompt' => '--pilih salah satu--', 'name'=>'DataSiswa[kelas]']) ?>

                    <?= $form->field($model, 'nis_siswa', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'nisn_siswa', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'nik_siswa', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'nama_siswa', $template)->textInput(['maxlength' => true]) ?>

                    <div class="demo-radio-button costum-form">
                        <h5 class="costum-label">Jenis Kelamin Siswa</h5>

                        <input name="DataSiswa[jenis_kelamin_siswa]" type="radio" id="jk_1" class="radio-col-blue" value="1" <?= $model->jenis_kelamin_siswa==1||$model->isNewRecord?'checked':''?> >
                        <label for="jk_1">LAKI-LAKI</label>

                        <input name="DataSiswa[jenis_kelamin_siswa]" type="radio" id="jk_2" class="radio-col-pink" value="2" <?= $model->jenis_kelamin_siswa==2?'checked':'' ?>  >
                        <label for="jk_2">PEREMPUAN</label>

                    </div>

                    <?= $form->field($model, 'tempat_lahir_siswa', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'tanggal_lahir_siswa', $template_ddl)->textInput(['class'=>'datepicker form-control']) ?>

                    <?= $form->field($model, 'hobi_siswa', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'cita_cita_siswa', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'help_foto')->fileInput() ?>

                    <?= $form->field($model, 'alamat_domisili', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'no_telp_orangtua', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'nama_ayah', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'nama_ibu', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'alamat_lengkap_orang_tua', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'kode_pos_orangtua', $template)->textInput() ?>


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
$js=<<< JAVASCRIPT

$('document').ready(function(){

$('#datasiswa-sekolah').change(function(){
    id=$(this).val();
        $.ajax({
              url: '$homeUrl\administrator/data_siswa/get_kelas',
              data: 'id='+id+'&_csrf=$csrf',
              type: 'POST',
              success:function(data){
                   $('#uid_kelas').html(data);
                   $('#datasiswa-kelas').selectpicker();
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
});
JAVASCRIPT;
$this->registerJS($js);
?>