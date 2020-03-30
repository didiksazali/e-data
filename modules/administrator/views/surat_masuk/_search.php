<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\search\StafSuratMasukSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staf-surat-masuk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'uid_surat_masuk') ?>

    <?= $form->field($model, 'no_surat') ?>

    <?= $form->field($model, 'dari') ?>

    <?= $form->field($model, 'id_google_drive') ?>

    <?= $form->field($model, 'tujuan_surat_kesekolah') ?>

    <?php // echo $form->field($model, 'maksud_surat') ?>

    <?php // echo $form->field($model, 'tindakan_yang_harus_dilakukan') ?>

    <?php // echo $form->field($model, 'estimasi_batas_tindakan') ?>

    <?php // echo $form->field($model, 'uid_kategori_surat') ?>

    <?php // echo $form->field($model, 'create_by') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
