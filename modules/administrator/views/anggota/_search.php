<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\search\AnggotaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anggota-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_anggota') ?>

    <?= $form->field($model, 'no_ktp') ?>

    <?= $form->field($model, 'no_id_pkdp') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'alamat_sekarang') ?>

    <?php // echo $form->field($model, 'tempat_lahir') ?>

    <?php // echo $form->field($model, 'tanggal_lahir') ?>

    <?php // echo $form->field($model, 'jk') ?>

    <?php // echo $form->field($model, 'no_hp') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'pekerjaan') ?>

    <?php // echo $form->field($model, 'id_pendidikan') ?>

    <?php // echo $form->field($model, 'dpw') ?>

    <?php // echo $form->field($model, 'dpd') ?>

    <?php // echo $form->field($model, 'dpc') ?>

    <?php // echo $form->field($model, 'alamat_kampung') ?>

    <?php // echo $form->field($model, 'id_penghasilan') ?>

    <?php // echo $form->field($model, 'prestasi') ?>

    <?php // echo $form->field($model, 'motivasi_bergabung') ?>

    <?php // echo $form->field($model, 'masukan_untuk_ranah') ?>

    <?php // echo $form->field($model, 'masukan_untuk_rantau') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <?php // echo $form->field($model, 'kk') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
