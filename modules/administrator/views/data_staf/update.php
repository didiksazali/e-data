<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\Staf */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Staf',
]) . $model_staf->nip.' ('.$model_staf->nama.')';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stafs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model_staf->uid_staf, 'url' => ['view', 'id' => $model_staf->uid_staf]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="staf-update">

    <?= $this->render('_form', [
        'model_staf' => $model_staf,
        'model_user' => $model_user,
        'jabatan'=> $jabatan,
    ]) ?>

</div>
