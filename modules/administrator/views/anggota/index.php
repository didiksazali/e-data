<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\search\AnggotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Anggota');
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

<div class="anggota-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Anggota'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_anggota',
            'no_ktp',
            'no_id_pkdp',
            'nama',
            //'alamat_sekarang',
            // 'tempat_lahir',
            // 'tanggal_lahir',
            // 'jk',
            // 'no_hp',
            // 'email:email',
            // 'pekerjaan',
            // 'id_pendidikan',
            // 'dpw',
            // 'dpd',
            // 'dpc',
            // 'alamat_kampung',
            // 'id_penghasilan',
            // 'prestasi',
            // 'motivasi_bergabung',
            // 'masukan_untuk_ranah',
            // 'masukan_untuk_rantau',
            // 'foto',
            array(
            'attribute'=>'foto',
            'format' => 'raw',
            'value'=>function($data) {
              return '<img src="'.Yii::$app->homeUrl.$data->foto.'" style="height:40px; width:60px"/>';
              },
            ),
            // 'kk',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
<!-- #END# Advanced Form Example With Validation -->
