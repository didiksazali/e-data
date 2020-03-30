<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\DataSiswa */

$this->title = Yii::t('app', 'Create Data Siswa');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Data Siswas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-siswa-create">

    <?= $this->render('_form', [
        'model' => $model,
        'sekolah'=> $sekolah,
    ]) ?>

</div>
