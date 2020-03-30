<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\Aturan */

$this->title = 'Update Aturan: ' . $model->id_aturan;
$this->params['breadcrumbs'][] = ['label' => 'Aturans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_aturan, 'url' => ['view', 'id' => $model->id_aturan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aturan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
