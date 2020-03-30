<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\ThemePartial;

ThemePartial::register($this);
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
<body class="five-zero-zero">
<?php $this->beginBody() ?>
<div class="five-zero-zero-container">
    <div class="error-code">UPS!!!</div>
    <div class="error-message">Anda Tidak Memiliki Izinkan Untuk Mengakses Halaman Ini</div>
    <div class="button-place">
        <a href="../../index.html" class="btn btn-default btn-lg waves-effect">GO TO HOMEPAGE</a>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
