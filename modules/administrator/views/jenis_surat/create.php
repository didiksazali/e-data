<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\StafJenisSurat */

$this->title = Yii::t('app', 'Create Staf Jenis Surat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Staf Jenis Surats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staf-jenis-surat-create">

    <?= $this->render('_form', [
        'model' => $model,
        'help_sekolah'=> $help_sekolah,
    ]) ?>

</div>
