<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\search\StafJenisSuratSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staf-jenis-surat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'uid_jenis_surat') ?>

    <?= $form->field($model, 'nama_jenis_surat') ?>

    <?= $form->field($model, 'uid_template_surat') ?>

    <?= $form->field($model, 'estimasi_selesai') ?>

    <?= $form->field($model, 'biaya') ?>

    <?php // echo $form->field($model, 'penomoran_otomatis') ?>

    <?php // echo $form->field($model, 'no_surat') ?>

    <?php // echo $form->field($model, 'default_attribute_tambahan') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'create_by') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
