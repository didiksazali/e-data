<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\Kelas */

$this->title = Yii::t('app', 'Create Kelas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kelas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-create">

    <?= $this->render('_form', [
        'model' => $model,
        'sekolah'=>$sekolah,
    ]) ?>

</div>
