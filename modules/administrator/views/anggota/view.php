<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\Anggota */

$this->title = $model->id_anggota;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Anggotas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Advanced Form Example With Validation -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2><?= strtoupper(Html::encode($this->title)); ?></h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Reload</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <?php if (Yii::$app->session->hasFlash('create_success')): ?>
                    <div class="alert bg-green alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <?= Yii::$app->session->getFlash('create_success') ?>
                    </div>
                <?php endif; ?>

                <div class="row clearfix">

                    <!-- With Captions -->
                    <div class="col-lg-9 col-md-6 col-sm-12 col-xs-12">
                        <div class="body">

<div class="anggota-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id_anggota], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id_anggota], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_anggota',
            'no_ktp',
            'no_id_pkdp',
            'nama',
            'alamat_sekarang',
            'tempat_lahir',
            'tanggal_lahir',
            'jk',
            'no_hp',
            'email:email',
            'pekerjaan',
            'id_pendidikan',
            'dpw',
            'dpd',
            'dpc',
            'alamat_kampung',
            'id_penghasilan',
            'prestasi',
            'motivasi_bergabung',
            'masukan_untuk_ranah',
            'masukan_untuk_rantau',
            //'foto',
            array(
            'attribute'=>'foto',
            'format' => 'raw',
            'value'=>function($data) {
              return '<img src="'.Yii::$app->homeUrl.$data->foto.'" style="height:40px; width:60px"/>';
              },
            ),
            //'kk',
            array(
           'attribute'=>'kk',
           'format' => 'raw',
           'value'=>function($data) {
             return '<img src="'.Yii::$app->homeUrl.$data->kk.'" style="height:40px; width:60px"/>';
             },
           ),
        ],
    ]) ?>

</div>
</div>
</div>


</div>
</div>
</div>
</div>
</div>
<!-- #END# Advanced Form Example With Validation -->
