<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\Aturan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aturan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_aturan')->textInput() ?>

    <?= $form->field($model, 'asal')->textInput() ?>

    <?= $form->field($model, 'tujuan')->textInput() ?>

    <?= $form->field($model, 'transit')->textInput() ?>

    <?= $form->field($model, 'dibuat_oleh')->textInput() ?>

    <?= $form->field($model, 'dibuat_tanggal')->textInput() ?>

    <?= $form->field($model, 'terakhir_diedit')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
