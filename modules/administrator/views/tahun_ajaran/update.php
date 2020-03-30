<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\TahunAjaran */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tahun Ajaran',
]) . $model->uid_thn_ajaran;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tahun Ajarans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uid_thn_ajaran, 'url' => ['view', 'id' => $model->uid_thn_ajaran]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tahun-ajaran-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
