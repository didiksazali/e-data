<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\assets\AppLogin;

AppLogin::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="login-page">
<?php $this->beginBody() ?>
<?php
$username= ['template'=> '<div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">person</i>
                                    </span>
                                <div class="form-line">
                                    {input}
                                </div>
                                {error}
                          </div>'];

$password= ['template'=> '<div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock</i>
                                    </span>
                                <div class="form-line">
                                   {input}
                                </div>
                                {error}
                          </div>'];
?>
<div class="login-box">

    <div class="logo">
        <a href="javascript:void(0);">
            <!-- <img class="image img-responsive" src="<?= Yii::$app->homeUrl.'img/logo/logo.png'; ?>"> -->
            <h2> Aplikasi e-Data PKDP RI Online </h2>
        </a>
        <small>Garuda Cyber Indonesia Team</small>
    </div>

    <div class="card">

        <?php if (Yii::$app->session->hasFlash('login_unsuccess')): ?>
            <div class="alert bg-pink alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <?= Yii::$app->session->getFlash('login_unsuccess') ?>
            </div>
        <?php endif; ?>

        <div class="body">
            <div class="msg">Silahkan Login Terlebih Dahulu</div>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
            ]); ?>
            <?= $form->field($model, 'username', $username)->textInput(['autofocus' => true, 'placeholder'=>'Username']) ?>
            <?= $form->field($model, 'password', $password)->passwordInput(['autofocus' => true, 'placeholder'=>'Password']) ?>

            <div class="row">
                <div class="col-xs-8 p-t-5">
                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"filled-in chk-col-pink\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    ]) ?>
                </div>
                <div class="col-xs-4">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-block bg-pink waves-effect', 'name' => 'login-button']) ?>
                </div>
            </div>

            <!-- <div class="row m-t-15 m-b--20">
                <div class="col-xs-12 align-right">
                    <a href="forgot-password.html">Forgot Password?</a>
                </div>
            </div> -->
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
