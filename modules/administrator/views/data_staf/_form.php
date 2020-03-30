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

                <div class="staf-data-staf-form">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                    <?= $form->field($model_staf, 'nip', $template)->textInput() ?>

                    <?= $form->field($model_staf, 'nama', $template)->textInput(['maxlength' => true]) ?>

                    <div class="demo-radio-button costum-form">
                        <h5 class="costum-label">Jenis Kelamin Siswa</h5>

                        <input name="jenis_kelamin" type="radio" id="jk_1" class="radio-col-blue" value="1" <?= $model_staf->jenis_kelamin==1||$model_staf->isNewRecord?'checked':''?> >
                        <label for="jk_1">LAKI-LAKI</label>

                        <input name="jenis_kelamin" type="radio" id="jk_2" class="radio-col-pink" value="2" <?= $model_staf->jenis_kelamin==2?'checked':'' ?>  >
                        <label for="jk_2">PEREMPUAN</label>

                    </div>

                    <?= $form->field($model_staf, 'foto')->fileInput() ?>

                    <?= $form->field($model_user, 'email', $template)->textInput(['maxlength' => true]) ?>

                    <?= $model_staf->isNewRecord? $form->field($model_staf, 'password', $template)->passwordInput(['maxlength' => true]):'' ?>

                    <?= $form->field($model_staf, 'alamat', $template)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model_staf, 'status_kepegawaian')->dropDownList([ 'pns' => 'Pns', 'honorer' => 'Honorer', 'lainnya' => 'Lainnya', ], ['prompt' => '--pilih satu--','class'=>'form-control show-tick']) ?>

                    <div class="demo-radio-button costum-form">
                        <h5 class="costum-label">Status Keluarga</h5>

                        <input name="status_keluarga" type="radio" id="sk_1" class="radio-col-blue" value="1" <?= $model_staf->status_keluarga==1||$model_staf->isNewRecord?'checked':''?> >
                        <label for="sk_1">BELUM MENIKAH</label>

                        <input name="status_keluarga" type="radio" id="sk_2" class="radio-col-pink" value="2" <?= $model_staf->status_keluarga==2?'checked':'' ?> >
                        <label for="sk_2">SUDAH MENIKAH</label>

                    </div>

                    <?= $form->field($model_staf, 'jabatan', $template_ddl)->dropDownList($jabatan, ['prompt' => '-- pilih salah satu --']) ?>

                    <div class="form-group">
                        <?= Html::submitButton($model_staf->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model_staf->isNewRecord ? 'btn bg-cyan btn-block btn-lg waves-effect' : 'btn bg-red btn-block btn-lg waves-effect']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Advanced Form Example With Validation -->