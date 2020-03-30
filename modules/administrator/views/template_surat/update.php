<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\StafTemplateSurat */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Staf Template Surat',
]) . $model->uid_template_surat;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Staf Template Surats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uid_template_surat, 'url' => ['view', 'id' => $model->uid_template_surat]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="staf-template-surat-update">

    <?= $this->render('_form', [
        'model' => $model,
        'sekolah'=>$sekolah,
    ]) ?>

</div>
