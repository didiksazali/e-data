<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\StafJenisSurat */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Staf Jenis Surat',
]) . $model->nama_jenis_surat;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Staf Jenis Surats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uid_jenis_surat, 'url' => ['view', 'id' => $model->uid_jenis_surat]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="staf-jenis-surat-update">

    <?= $this->render('_form', [
        'model' => $model,
        'help_sekolah'=> $help_sekolah,
        'help_template_surat'=> $help_template_surat,
    ]) ?>

</div>
