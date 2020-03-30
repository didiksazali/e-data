<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\general\Staf */

$this->title = 'Data Siswa: '.$model->nama_siswa;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Data Siswas'), 'url' => ['index']];
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
                            <div class="data-siswa-view">
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => $attributes,
                                ]) ?>
                            </div>
                            <p>
                                <?= \Yii::$app->user->can('app/administrator/data_staf/update')?Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->uid_siswa], ['class' => 'btn bg-teal btn-lg waves-effect']):''; ?>
                                <?= \Yii::$app->user->can('app/administrator/data_staf/delete')?'<a href="#"><button class="delete btn bg-red btn-lg waves-effect" id="'.$model->uid_siswa.'">Delete</button></a>':'' ?>
                            </p>
                        </div>
                    </div>
                    <!-- #END# With Captions -->
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="body" id="photo-profile">
                            <a id="link_img" href="<?= $model->jenis_kelamin_siswa==1?yii::$app->homeUrl.'img/icon/default_male.png':yii::$app->homeUrl.'img/icon/default_female.png';?>" data-sub-html="Demo Description">
                                <img id="show_img" class="img-responsive thumbnail" src="<?= $model->jenis_kelamin_siswa==1?yii::$app->homeUrl.'img/icon/default_male.png':yii::$app->homeUrl.'img/icon/default_female.png';?>">
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</div>
<!-- #END# Advanced Form Example With Validation -->

<?php


$id= $model->gdrive_pasfoto_siswa;
$homeUrl=Yii::$app->homeUrl;
$csrf=Yii::$app->request->getCsrfToken();
$cek= $model->gdrive_pasfoto_siswa==''||$model->gdrive_pasfoto_siswa==NULL?0:1;
$js=<<< JAVASCRIPT

    function loadFoto(){
          $.ajax({
              url: '$homeUrl\administrator/data_siswa/get_foto',
              data: 'id=$id&_csrf=$csrf',
              type: 'POST',
              success:function(data){
                    $('#show_img').attr('src',data);
                    $('#link_img').attr('href',data);
              }
          });
              
    }

    $('document').ready(function(){
        if('$cek'!=0){
            loadFoto();
        }

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
              url: '$homeUrl\administrator/data_siswa/delete',
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
              window.location='$homeUrl\administrator/data_siswa/index';
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
