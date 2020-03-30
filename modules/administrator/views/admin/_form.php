<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\User */
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

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username', $template)->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash', $template)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_reset_token', $template)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email', $template)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status', $template)->textInput() ?>

    <?= $form->field($model, 'role', $template)->textInput() ?>

    <?= $form->field($model, 'jabatan', $template)->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'created_at')->textInput() ?>

    <?php //= $form->field($model, 'updated_at')->textInput() ?>

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

</div>
