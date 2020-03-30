<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\Anggota */
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

<div class="anggota-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'no_ktp', $template)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_id_pkdp', $template)->textInput() ?>

    <?= $form->field($model, 'nama', $template)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat_sekarang', $template)->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempat_lahir', $template)->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_lahir', $template_ddl)->textInput(['class'=>'datepicker form-control']) ?>

    <?php // $form->field($model, 'jk', $template)->textInput(['maxlength' => true]) ?>
    <div class="demo-radio-button costum-form">
        <h5 class="costum-label">Jenis Kelamin</h5>

        <input name="Anggota[jk]" type="radio" id="jk_1" class="radio-col-blue" value="1" <?= $model->jk==1||$model->isNewRecord?'checked':''?> >
        <label for="jk_1">LAKI-LAKI</label>

        <input name="Anggota[jk]" type="radio" id="jk_2" class="radio-col-pink" value="2" <?= $model->jk==2?'checked':'' ?>  >
        <label for="jk_2">PEREMPUAN</label>

    </div>

    <?= $form->field($model, 'no_hp', $template)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email', $template)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pekerjaan', $template)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_pendidikan', $template_ddl)->dropDownList($pendidikan, ['prompt' => '--pilih salah satu--']) ?>

    <?= $form->field($model, 'dpw', $template)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dpd', $template)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dpc', $template)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat_kampung', $template)->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_penghasilan', $template_ddl)->dropDownList($penghasilan, ['prompt' => '--pilih salah satu--']) ?>

    <?= $form->field($model, 'prestasi', $template)->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'motivasi_bergabung', $template)->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'masukan_untuk_ranah', $template)->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'masukan_untuk_rantau', $template)->textArea(['maxlength' => true]) ?>

    <?php if (!$model->isNewRecord&&$model->foto!='') {
      echo '<img src="'.Yii::$app->homeUrl.$model->foto.'" style="height:40px; width:60px">';
    }?>

    <?= $form->field($model, 'fotoHelper')->fileInput() ?>

    <?php if (!$model->isNewRecord&&$model->kk!='') {
      echo '<img src="'.Yii::$app->homeUrl.$model->kk.'" style="height:40px; width:60px">';
    }?>
    <?= $form->field($model, 'kkHelper')->fileInput() ?>

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
