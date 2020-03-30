<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\DmSekolah */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Dm Sekolah',
]) . $model->uid_dm_sekolah;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dm Sekolahs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uid_dm_sekolah, 'url' => ['view', 'id' => $model->uid_dm_sekolah]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="dm-sekolah-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
