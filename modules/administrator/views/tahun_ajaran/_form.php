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

                <div class="tahun-ajaran-form">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'kode_tahun_ajaran', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'nama', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'tanggal_mulai', $template_ddl)->textInput(['class'=>'datepicker form-control']) ?>

                    <?= $form->field($model, 'tanggal_selesai', $template_ddl)->textInput(['class'=>'datepicker form-control']) ?>

                    <div class="demo-radio-button costum-form">
                        <h5 class="costum-label">Status</h5>

                        <input name="TahunAjaran[status]" type="radio" id="sts_1" class="radio-col-blue" value="1" <?= $model->status==1||$model->isNewRecord?'checked':''?> >
                        <label for="sts_1">AKTIF</label>

                        <input name="TahunAjaran[status]" type="radio" id="sts_2" class="radio-col-pink" value="2" <?= $model->status==2?'checked':'' ?>  >
                        <label for="sts_2">TIDAK AKTIF</label>

                    </div>

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




