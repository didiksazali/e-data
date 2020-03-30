<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\StafBuatSurat */

$this->title = Yii::t('app', 'Create Staf Buat Surat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Staf Buat Surats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staf-buat-surat-create">

    <?= $this->render('_form', [
        'model' => $model,
        'sekolah' => $sekolah,
    ]) ?>

</div>
