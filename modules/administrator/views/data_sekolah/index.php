<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\search\StafSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Dm Sekolahs');
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

                <div class="dm-sekolah-index">

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    <p>
                        <?= \Yii::$app->user->can('app/administrator/data_sekolah/create')? Html::a(Yii::t('app', 'TAMBAH SEKOLAH BARU'), ['create'], ['class' => 'button button-3d button-primary button-rounded waves-effect']):'' ?>
                    </p>

                    <?php
                    $action= '';
                    if(\Yii::$app->user->can('app/administrator/data_kelas/view')){
                        $action= $action.'{view} ';
                    }
                    if(\Yii::$app->user->can('app/administrator/data_kelas/update')){
                        $action= $action.'{update} ';
                    }
                    if(\Yii::$app->user->can('app/administrator/data_kelas/delete')){
                        $action= $action.'{delete} ';
                    }
                    ?>

                    <?= GridView::widget([
                        'dataProvider'=> $dataProvider,
                        'filterModel' => $searchModel,
                        //'columns' => $gridColumns,
                        'columns' => [
                            ['class' => 'kartik\grid\SerialColumn'],
                            'npsn',
                            'nss_nsm',
                            [
                                'attribute' => 'jenjang_sekolah',
                                //'label'=> 'Status Sekolah',
                                'format'=>'raw',
                                //'width' => '150px',
                                //'headerOptions' => ['style' => 'width:20%'],
                                'value' => function ($models) {
                                    return '<span class="label bg-blue">'.strtoupper($models->jenjang_sekolah).'</span>';
                                }
                            ],
                            'nama',
                            // 'alamat',
                            // 'kode_pos',
                            // 'status',
                            // 'akreditas',
                            // 'logo',
                            // 'no_telp',
                            // 'fax',
                            // 'email:email',
                            // 'tagline',
                            // 'visi:ntext',
                            // 'misi:ntext',
                            // 'create_by',
                            // 'create_at',
                            // 'update_at',
                            [
                                'class' => '\kartik\grid\ActionColumn',
                                'buttons'=>[
                                    'delete'=>function($url, $model){
                                        return '<button id="'.$model->uid_dm_sekolah.'" title="Delete" class="delete button button-caution button-square button-small button-longshadow-right"><i class="glyphicon glyphicon-trash"></i></button>';
                                    }
                                ],
                                'viewOptions'   => ['label' => '<button class="button button-primary button-square button-small button-longshadow-right"><i class="glyphicon glyphicon-file"></i></button>'],
                                'updateOptions' => ['label' => '<button class="button button-action button-square button-small button-longshadow-right"><i class="glyphicon glyphicon-pencil"></i></button>'],
                                'width' => '150px',
                                'template' => $action,
                            ]
                        ],
                        'bordered' => false,
                        'striped' => false,
                        'condensed' => false,
                        'responsive' => true,
                        'hover' => false,
                        'floatHeader' => false,
                        'pjax'=>true,
                        'pjaxSettings'=>[
                            'neverTimeout'=>true,
                            //'beforeGrid'=>'My fancy content before.',
                            //'afterGrid'=>'My fancy content after.',
                        ],
                        // set your toolbar
                        'panel' => [
                            'type' => GridView::TYPE_DEFAULT,
                            'after'=>false,
                            'footer'=>false,
                            'toolbar'=>false,
                            // 'heading'=>false,
                        ],
                    ]); ?>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- #END# Advanced Form Example With Validation -->


<?php
$homeUrl=Yii::$app->homeUrl;
$csrf=Yii::$app->request->getCsrfToken();
$js=<<< JAVASCRIPT
    $('document').ready(function(){
            $('.delete').click(function(){
            var id= $(this).attr('id');
            var tmp='0';
            swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            buttonsStyling: true,
            showLoaderOnConfirm: true,
             preConfirm: function (data) {
              return new Promise(function (resolve, reject) {
    
            $.ajax({
              url: '$homeUrl\administrator/data_sekolah/delete',
              data: 'id='+id+'&_csrf=$csrf',
              type: 'POST',
              success:function(data){
                if(data==1){
                  tmp='1';
                  resolve();
                }
                else if(data==0){
                  tmp='0';
                  resolve();
                }
                else{
                  tmp='-1';
                  resolve();
                }
            
              },
            });
    
        })
              },
    
          }).then(function () {
            if(tmp==1){
                swal(
                'Delete Success',
                'Data berhasil di hapus :)',
                'success'
              ).then(function () {
              window.location.reload();
            });
            }
            else if(tmp==0){
               swal(
                'Oups Galat!!!',
                'Sepertinya ada yang salah, coba ulangi',
                'error'
              ).then(function () {
              window.location.reload();
            });
            }
            else{
                swal(
                'Ups!!!',
                'Anda Tidak memiliki hak untuk menghapus lagi',
                'error'
              ).then(function () {
              window.location.reload();
            });
            }
           
          }, function (dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
              swal(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
              )
            }
          });
        });
    });
JAVASCRIPT;
$this->registerJS($js);
?>

