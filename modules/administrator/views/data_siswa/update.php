<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\DataSiswa */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Data Siswa',
]) . $model->nama_siswa;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Data Siswas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uid_siswa, 'url' => ['view', 'id' => $model->uid_siswa]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="data-siswa-update">

    <?= $this->render('_form', [
        'model' => $model,
        'sekolah'=> $sekolah,
        'kelas'=> $kelas,
    ]) ?>

</div>
