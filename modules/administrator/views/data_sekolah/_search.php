<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\search\DmSekolahSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dm-sekolah-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'uid_dm_sekolah') ?>

    <?= $form->field($model, 'npsn') ?>

    <?= $form->field($model, 'nss_nsm') ?>

    <?= $form->field($model, 'jenjang_sekolah') ?>

    <?= $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'kode_pos') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'akreditas') ?>

    <?php // echo $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'no_telp') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'tagline') ?>

    <?php // echo $form->field($model, 'visi') ?>

    <?php // echo $form->field($model, 'misi') ?>

    <?php // echo $form->field($model, 'create_by') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
