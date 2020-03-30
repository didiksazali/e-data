<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\StafBuatSurat */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Surat',
]) . $model->uidJenisSurat->nama_jenis_surat.' ('.$model->uidDataSiswa->nama_siswa.')';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Staf Buat Surats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uid_buat_surat, 'url' => ['view', 'id' => $model->uid_buat_surat]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="staf-buat-surat-update">

    <?= $this->render('_form', [
        'model' => $model,
        'sekolah'=>$sekolah,
        'jenis_surat'=> $jenis_surat,
    ]) ?>

</div>
