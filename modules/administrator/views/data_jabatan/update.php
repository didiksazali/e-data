<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\DmJabatan */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Dm Jabatan',
]) . $model->kode_jabatan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dm Jabatans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_jabatan, 'url' => ['view', 'id' => $model->kode_jabatan]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="dm-jabatan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
