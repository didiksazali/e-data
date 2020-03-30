<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\DmSekolah */

$this->title = Yii::t('app', 'Create Dm Sekolah');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dm Sekolahs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dm-sekolah-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
