<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\AturanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aturan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_aturan') ?>

    <?= $form->field($model, 'asal') ?>

    <?= $form->field($model, 'tujuan') ?>

    <?= $form->field($model, 'transit') ?>

    <?= $form->field($model, 'dibuat_oleh') ?>

    <?php // echo $form->field($model, 'dibuat_tanggal') ?>

    <?php // echo $form->field($model, 'terakhir_diedit') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
