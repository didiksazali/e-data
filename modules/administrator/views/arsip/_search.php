<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\search\DataKelasSearch2 */
/* @var $form yii\widgets\ActiveForm */

$template=['template'=>'<div class="input-group colorpicker colorpicker-element">
                                        <div class="form-line">
                                            {input}
                                        </div>
                                        <span class="input-group-addon">
                                            <button type="submit"><i class="material-icons">&#xE8B6;</i></button>
                                        </span>
                                    </div>'];
?>

<div class="kelas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="form-group">
        <?= $form->field($model, 'uid_surat_masuk', $template) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
