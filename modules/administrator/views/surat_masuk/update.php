<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\StafSuratMasuk */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Staf Surat Masuk',
]) . $model->no_surat;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Staf Surat Masuks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uid_surat_masuk, 'url' => ['view', 'id' => $model->uid_surat_masuk]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="staf-surat-masuk-update">

    <?= $this->render('_form', [
        'model' => $model,
             'kategori_surat'=> $kategori_surat,
             'sekolah'=> $sekolah,
             'beban_kerja_kepada'=>$beban_kerja_kepada,
    ]) ?>

</div>
