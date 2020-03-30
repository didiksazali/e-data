<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\search\DataSiswaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-siswa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'uid_siswa') ?>

    <?= $form->field($model, 'nis_siswa') ?>

    <?= $form->field($model, 'nisn_siswa') ?>

    <?= $form->field($model, 'nik_siswa') ?>

    <?= $form->field($model, 'nama_siswa') ?>

    <?php // echo $form->field($model, 'jenis_kelamin_siswa') ?>

    <?php // echo $form->field($model, 'tempat_lahir_siswa') ?>

    <?php // echo $form->field($model, 'tanggal_lahir_siswa') ?>

    <?php // echo $form->field($model, 'hobi_siswa') ?>

    <?php // echo $form->field($model, 'cita_cita_siswa') ?>

    <?php // echo $form->field($model, 'gdrive_pasfoto_siswa') ?>

    <?php // echo $form->field($model, 'jumlah_saudara_siswa') ?>

    <?php // echo $form->field($model, 'tinggi_badan_siswa') ?>

    <?php // echo $form->field($model, 'berat_badan_siswa') ?>

    <?php // echo $form->field($model, 'jenis_tempat_tinggal') ?>

    <?php // echo $form->field($model, 'alamat_domisili') ?>

    <?php // echo $form->field($model, 'jarak_domisili_kesekolah') ?>

    <?php // echo $form->field($model, 'id_transportasi_kesekolah') ?>

    <?php // echo $form->field($model, 'no_kk') ?>

    <?php // echo $form->field($model, 'no_telp_orangtua') ?>

    <?php // echo $form->field($model, 'nama_ayah') ?>

    <?php // echo $form->field($model, 'no_ktp_ayah') ?>

    <?php // echo $form->field($model, 'id_pendidikan_ayah') ?>

    <?php // echo $form->field($model, 'id_pekerjaan_ayah') ?>

    <?php // echo $form->field($model, 'nama_ibu') ?>

    <?php // echo $form->field($model, 'no_ktp_ibu') ?>

    <?php // echo $form->field($model, 'id_pendidikan_ibu') ?>

    <?php // echo $form->field($model, 'id_pekerjaan_ibu') ?>

    <?php // echo $form->field($model, 'id_penghasilan_orangtua_perbulan') ?>

    <?php // echo $form->field($model, 'alamat_lengkap_orang_tua') ?>

    <?php // echo $form->field($model, 'id_area_kelurahan_orang_tua') ?>

    <?php // echo $form->field($model, 'kode_pos_orangtua') ?>

    <?php // echo $form->field($model, 'jarak_rumah_kesekolah') ?>

    <?php // echo $form->field($model, 'id_alat_transport_orangtua') ?>

    <?php // echo $form->field($model, 'nama_wali') ?>

    <?php // echo $form->field($model, 'no_telp_wali') ?>

    <?php // echo $form->field($model, 'hubungan_dengan_wali') ?>

    <?php // echo $form->field($model, 'id_pekerjaan_wali') ?>

    <?php // echo $form->field($model, 'no_kks_kps') ?>

    <?php // echo $form->field($model, 'no_kartu_pkh') ?>

    <?php // echo $form->field($model, 'no_kip') ?>

    <?php // echo $form->field($model, 'kebutuhan_tuna_rungu') ?>

    <?php // echo $form->field($model, 'kebutuhan_tuna_daksa') ?>

    <?php // echo $form->field($model, 'kebutuhan_tuna_laras') ?>

    <?php // echo $form->field($model, 'kebutuhan_tuna_belajar') ?>

    <?php // echo $form->field($model, 'kebutuhan_tuna_grahita') ?>

    <?php // echo $form->field($model, 'kebutuhan_tuna_netra') ?>

    <?php // echo $form->field($model, 'kebutuhan_lamban_belajar') ?>

    <?php // echo $form->field($model, 'kebutuhan_sulit_belajar') ?>

    <?php // echo $form->field($model, 'kebutuhan_bakat_luar_biasa') ?>

    <?php // echo $form->field($model, 'kebutuhan_gangguan_komunikasi') ?>

    <?php // echo $form->field($model, 'status_siswa') ?>

    <?php // echo $form->field($model, 'create_by') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
