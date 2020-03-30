<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\search\DataKelasSearch2 */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Kelas');
$this->params['breadcrumbs'][] = $this->title;
$warna= ['header bg-pink', 'header bg-blue-grey ', 'header bg-orange', 'header bg-green', 'header bg-red', 'header bg-cyan'];

?>
<style>
    td, th{
        padding: 3px;
    }
</style>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    TABS WITH ICON TITLE
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home_with_icon_title" data-toggle="tab">
                            <i class="material-icons">home</i> ARSIP SURAT MASUK
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#profile_with_icon_title" data-toggle="tab">
                            <i class="material-icons">face</i> ARSIP SURAT KELUAR
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                        <div class="container-fluid">
                            <div class="block-header">
                                <?php echo $this->render('_search', ['model' => $searchModelSuratMasuk]); ?>
                            </div>
                            <!-- Basic Example -->
                            <!--start-->

                            <div class="row clearfix">
                                <?php Pjax::begin(); ?>
                                <?= ListView::widget([
                                    'dataProvider' => $dataProviderSuratMasuk,
                                    'itemOptions' => ['class' => 'item'],
                                    'itemView' => function ($model, $key, $index, $widget) {
                                        $warna= ['header bg-light-green', 'header bg-orange', 'header bg-green', 'header bg-red', 'header bg-cyan', 'header bg-pink', 'header bg-amber'];
                                        switch ($index%7){
                                            case 0;
                                                $warna=$warna[6];
                                                break;
                                            case 1;
                                                $warna=$warna[5];
                                                break;
                                            case 2;
                                                $warna=$warna[4];
                                                break;
                                            case 3;
                                                $warna=$warna[3];
                                                break;
                                            case 4;
                                                $warna=$warna[2];
                                                break;
                                            case 5;
                                                $warna=$warna[1];
                                                break;
                                            case 6;
                                                $warna=$warna[0];
                                                break;
                                        }
                                        return '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="card">
                                        <div class="'.$warna.'">
                                            <h2>
                                                '.date('d-m-Y', strtotime($model->tanggal_masuk)).'<small>'.$model->no_surat.' </small>
                                            </h2>
                                            <ul class="header-dropdown m-r--5">
                                                <li>
                                                    <a href="'.yii::$app->params['googleDrive']['readUrl'].$model->id_google_drive.'" target="_blink">
                                                        <i class="material-icons">file_download</i>
                                                    </a>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li><a href="'.Yii::$app->homeUrl.'administrator/surat_masuk/view?id='.$key.'" class=" waves-effect waves-block">Lihat</a></li>
                                                        <li><a href="'.Yii::$app->homeUrl.'administrator/surat_masuk/update?id='.$key.'">Ubah</a></li>
                                                         <li><a href="javascript:void(0);" id="'.$key.'" class="delete waves-effect waves-block">Hapus</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="body">
                                            <table>
                                                <tr>
                                                    <td>
                                                        Dari
                                                    </td>
                                                    <td>
                                                        :
                                                    </td>
                                                    <td>
                                                        <span class="label bg-cyan">'.$model->dari.'</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Tujuan
                                                    </td>
                                                    <td>
                                                        :
                                                    </td>
                                                    <td>
                                                        <span class="label bg-pink">'.$model->tujuanSuratKesekolah->nama.'</span>
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td>
                                                        Kategori Surat
                                                    </td>
                                                    <td>
                                                        :
                                                    </td>
                                                    <td>
                                                        <span class="label bg-orange">'.$model->uidKategoriSurat->nama_kategori.'</span>
                                                    </td>
                                                </tr>
                                            </table>                                   
                                        </div>
                                    </div>
                                </div>';
                                    },
                                    'pager' => [
                                        'class' => \kop\y2sp\ScrollPager::className(),
                                        'noneLeftText'=>'Last Data',
                                        'noneLeftTemplate'=>'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">{text}</div>',
                                        //'container' => '.grid-view tbody',
                                        //'item' => 'tr',
                                        //'paginationSelector' => '.grid-view .pagination',
                                        //'triggerText'=> 'fa fa-pencil',
                                        'eventOnScroll'=>null,
                                        'triggerTemplate' => '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><button class="button button-caution-flat" style="cursor: pointer;"><span class="fa fa-refresh"></span> LOAD MORE</button></div>',
                                    ]
                                ]) ?>
                                <?php Pjax::end(); ?>
                            </div>

                            <!--end-->
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                        <div class="block-header">
                            <?php echo $this->render('_search', ['model' => $searchModelSuratMasuk]); ?>
                        </div>
                        <div class="row clearfix">
                            <?php Pjax::begin([]); ?>
                            <?= ListView::widget([
                                'dataProvider' => $dataProviderSuratKeluar,
                                'itemOptions' => ['class' => 'item'],
                                'itemView' => function ($model, $key, $index, $widget) {
                                    $warna= ['header bg-light-green', 'header bg-orange', 'header bg-green', 'header bg-red', 'header bg-cyan', 'header bg-pink', 'header bg-amber'];
                                    switch ($index%7){
                                        case 0;
                                            $warna=$warna[6];
                                            break;
                                        case 1;
                                            $warna=$warna[5];
                                            break;
                                        case 2;
                                            $warna=$warna[4];
                                            break;
                                        case 3;
                                            $warna=$warna[3];
                                            break;
                                        case 4;
                                            $warna=$warna[2];
                                            break;
                                        case 5;
                                            $warna=$warna[1];
                                            break;
                                        case 6;
                                            $warna=$warna[0];
                                            break;
                                    }
                                    return '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="card">
                                        <div class="'.$warna.'">
                                            <h2>
                                                '.date('d-m-Y', strtotime($model->create_at)).'<small>'.$model->no_surat.' </small>
                                            </h2>
                                            <ul class="header-dropdown m-r--5">
                                                <li>
                                                    <a href="'.yii::$app->params['googleDrive']['readUrl'].$model->gdrive_scan_document.'" target="_blink">
                                                        <i class="material-icons">file_download</i>
                                                    </a>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li><a href="'.Yii::$app->homeUrl.'administrator/surat_masuk/view?id='.$key.'" class=" waves-effect waves-block">Lihat</a></li>
                                                        <li><a href="'.Yii::$app->homeUrl.'administrator/surat_masuk/update?id='.$key.'">Ubah</a></li>
                                                         <li><a href="javascript:void(0);" id="'.$key.'" class="delete waves-effect waves-block">Hapus</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="body">
                                            <table>
                                                <tr>
                                                    <td>
                                                        Instansi
                                                    </td>
                                                    <td>
                                                        :
                                                    </td>
                                                    <td>
                                                        <span class="label bg-cyan">'.$model->uidJenisSurat->uidTemplateSurat->uidUntukSekolah->nama.'</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Nama (Siswa)
                                                    </td>
                                                    <td>
                                                        :
                                                    </td>
                                                    <td>
                                                        <span class="label bg-orange">'.$model->uidDataSiswa->nama_siswa.'</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        NIS/ NISN
                                                    </td>
                                                    <td>
                                                        :
                                                    </td>
                                                    <td>
                                                        <span class="label bg-red">'.$model->uidDataSiswa->nis_siswa.'/ '.$model->uidDataSiswa->nisn_siswa.'</span>
                                                    </td>
                                                </tr>
                                            </table>                                   
                                        </div>
                                    </div>
                                </div>';
                                },
                                'pager' => [
                                    'class' => \kop\y2sp\ScrollPager::className(),
                                    'noneLeftText'=>'Last Data',
                                    'noneLeftTemplate'=>'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">{text}</div>',
                                    //'container' => '.grid-view tbody',
                                    //'item' => 'tr',
                                    //'paginationSelector' => '.grid-view .pagination',
                                    //'triggerText'=> 'fa fa-pencil',
                                    'eventOnScroll'=>null,
                                    'triggerTemplate' => '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><button class="button button-caution-flat" style="cursor: pointer;"><span class="fa fa-refresh"></span> LOAD MORE</button></div>',

                                ]
                            ]) ?>
                            <?php Pjax::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



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
    url: '$homeUrl\administrator/surat_masuk/delete',
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
    'Success',
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