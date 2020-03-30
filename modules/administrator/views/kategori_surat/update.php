<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\StafKategoriSurat */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Staf Kategori Surat',
]) . $model->nama_kategori;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Staf Kategori Surats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uid_kategori_surat, 'url' => ['view', 'id' => $model->uid_kategori_surat]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="staf-kategori-surat-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
