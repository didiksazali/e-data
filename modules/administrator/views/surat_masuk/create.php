<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\StafSuratMasuk */

$this->title = Yii::t('app', 'Create Staf Surat Masuk');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Staf Surat Masuks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staf-surat-masuk-create">

    <?= $this->render('_form', [
        'model' => $model,
        'kategori_surat'=>$kategori_surat,
        'sekolah'=>$sekolah,
        'beban_kerja_kepada'=> $beban_kerja_kepada,
    ]) ?>

</div>
