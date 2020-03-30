<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\StafKategoriSurat */

$this->title = Yii::t('app', 'Create Kategori Surat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Staf Kategori Surats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staf-kategori-surat-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
