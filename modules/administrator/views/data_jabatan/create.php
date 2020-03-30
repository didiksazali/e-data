<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\DmJabatan */

$this->title = Yii::t('app', 'Create Dm Jabatan');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dm Jabatans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dm-jabatan-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
