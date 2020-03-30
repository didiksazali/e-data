<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\search\StafSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Data Siswas');
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

                    <div class="data-siswa-index">

                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                        <p>
                            <?= \Yii::$app->user->can('app/administrator/data_staf/create')? Html::a(Yii::t('app', 'TAMBAH SISWA BARU'), ['create'], ['class' => 'button button-3d button-primary button-rounded waves-effect']):'' ?>
                        </p>

                        <?php
                        $action= '';
                        if(\Yii::$app->user->can('app/administrator/data_staf/view')){
                            $action= $action.'{view} ';
                        }
                        if(\Yii::$app->user->can('app/administrator/data_staf/update')){
                            $action= $action.'{update} ';
                        }
                        if(\Yii::$app->user->can('app/administrator/data_staf/delete')){
                            $action= $action.'{delete} ';
                        }
                        ?>

                        <?= GridView::widget([
                            'dataProvider'=> $dataProvider,
                            'filterModel' => $searchModel,
                            //'columns' => $gridColumns,
                            'columns' => [
                                ['class' => 'kartik\grid\SerialColumn'],
                                'nis_siswa',
                                'nama_siswa',
                                'jenis_kelamin_siswa',
                                'tempat_lahir_siswa',
                                'tanggal_lahir_siswa',
                                // 'hobi_siswa',
                                // 'cita_cita_siswa',
                                // 'gdrive_pasfoto_siswa',
                                // 'jumlah_saudara_siswa',
                                // 'tinggi_badan_siswa',
                                // 'berat_badan_siswa',
                                // 'jenis_tempat_tinggal',
                                // 'alamat_domisili',
                                // 'jarak_domisili_kesekolah',
                                // 'id_transportasi_kesekolah',
                                // 'no_kk',
                                // 'no_telp_orangtua',
                                // 'nama_ayah',
                                // 'no_ktp_ayah',
                                // 'id_pendidikan_ayah',
                                // 'id_pekerjaan_ayah',
                                // 'nama_ibu',
                                // 'no_ktp_ibu',
                                // 'id_pendidikan_ibu',
                                // 'id_pekerjaan_ibu',
                                // 'id_penghasilan_orangtua_perbulan',
                                // 'alamat_lengkap_orang_tua',
                                // 'id_area_kelurahan_orang_tua',
                                // 'kode_pos_orangtua',
                                // 'jarak_rumah_kesekolah',
                                // 'id_alat_transport_orangtua',
                                // 'nama_wali',
                                // 'no_telp_wali',
                                // 'hubungan_dengan_wali',
                                // 'id_pekerjaan_wali',
                                // 'no_kks_kps',
                                // 'no_kartu_pkh',
                                // 'no_kip',
                                // 'kebutuhan_tuna_rungu',
                                // 'kebutuhan_tuna_daksa',
                                // 'kebutuhan_tuna_laras',
                                // 'kebutuhan_tuna_belajar',
                                // 'kebutuhan_tuna_grahita',
                                // 'kebutuhan_tuna_netra',
                                // 'kebutuhan_lamban_belajar',
                                // 'kebutuhan_sulit_belajar',
                                // 'kebutuhan_bakat_luar_biasa',
                                // 'kebutuhan_gangguan_komunikasi',
                                // 'status_siswa',
                                // 'create_by',
                                // 'create_at',
                                // 'update_at',

                                [
                                    'class' => '\kartik\grid\ActionColumn',
                                    'buttons'=>[
                                        'delete'=>function($url, $model){
                                            return '<button id="'.$model->uid_siswa.'" title="Delete" class="delete button button-caution button-square button-small button-longshadow-right"><i class="glyphicon glyphicon-trash"></i></button>';
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
                                'footer'=>'',
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
