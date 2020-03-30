<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\Staf */

$this->title = Yii::t('app', 'Create Staf');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stafs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staf-create">

    <?= $this->render('_form', [
        'model_staf' => $model_staf,
        'model_user' => $model_user,
        'jabatan'=> $jabatan,
    ]) ?>

</div>
