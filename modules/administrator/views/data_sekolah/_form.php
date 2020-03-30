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


                    <div class="dm-sekolah-form">

                        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                        <?= $form->field($model, 'npsn', $template)->textInput() ?>

                        <?= $form->field($model, 'nss_nsm', $template)->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'jenjang_sekolah', $template_ddl)->dropDownList([ 'paud' => 'Paud', 'tk' => 'Tk', 'sd' => 'Sd', 'mi' => 'Mi', 'smp' => 'Smp', 'mts' => 'Mts', 'sma' => 'Sma', 'smk' => 'Smk', 'ma' => 'Ma', ], ['prompt' => '--pilih satu--']) ?>

                        <?= $form->field($model, 'nama', $template)->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'alamat', $template)->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'kode_pos', $template)->textInput() ?>

                        <?= $form->field($model, 'status', $template_ddl)->dropDownList([ 'negeri' => 'Negeri', 'swasta' => 'Swasta', ], ['prompt' => '--pilih satu--']) ?>

                        <?= $form->field($model, 'akreditas', $template_ddl)->dropDownList(['A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'D'], ['prompt'=>'--pilih satu--']) ?>

                        <?= $form->field($model, 'logo_helper')->fileInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'no_telp', $template)->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'fax', $template)->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'email', $template)->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'tagline', $template)->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'visi', $template)->textarea(['rows' => 6]) ?>

                        <?= $form->field($model, 'misi', $template)->textarea(['rows' => 6]) ?>

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