<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\search\BuatSuratSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staf-buat-surat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'uid_buat_surat') ?>

    <?= $form->field($model, 'no_urut') ?>

    <?= $form->field($model, 'uid_jenis_surat') ?>

    <?= $form->field($model, 'uid_data_siswa') ?>

    <?= $form->field($model, 'estimasi_selesai_tanggal') ?>

    <?php // echo $form->field($model, 'biaya_optional') ?>

    <?php // echo $form->field($model, 'attribute_tambahan_optional') ?>

    <?php // echo $form->field($model, 'create_by') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
