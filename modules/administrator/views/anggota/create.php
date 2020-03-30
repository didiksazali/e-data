<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\Anggota */

$this->title = Yii::t('app', 'Create Anggota');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Anggota'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pendidikan' => $pendidikan,
        'penghasilan' => $penghasilan,
    ]) ?>

</div>
