<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\StafTemplateSurat */

$this->title = Yii::t('app', 'Create Staf Template Surat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Staf Template Surats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staf-template-surat-create">

    <?= $this->render('_form', [
        'model' => $model,
        'sekolah'=>$sekolah,
    ]) ?>

</div>
