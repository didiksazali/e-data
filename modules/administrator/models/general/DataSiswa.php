<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "data_siswa".
 *
 * @property string $uid_siswa
 * @property string $nis_siswa
 * @property string $nisn_siswa
 * @property string $nik_siswa
 * @property string $nama_siswa
 * @property integer $jenis_kelamin_siswa
 * @property string $tempat_lahir_siswa
 * @property string $tanggal_lahir_siswa
 * @property string $hobi_siswa
 * @property string $cita_cita_siswa
 * @property string $gdrive_pasfoto_siswa
 * @property integer $jumlah_saudara_siswa
 * @property integer $tinggi_badan_siswa
 * @property integer $berat_badan_siswa
 * @property integer $jenis_tempat_tinggal
 * @property string $alamat_domisili
 * @property integer $jarak_domisili_kesekolah
 * @property integer $id_transportasi_kesekolah
 * @property integer $no_kk
 * @property string $no_telp_orangtua
 * @property string $nama_ayah
 * @property integer $no_ktp_ayah
 * @property integer $id_pendidikan_ayah
 * @property integer $id_pekerjaan_ayah
 * @property string $nama_ibu
 * @property integer $no_ktp_ibu
 * @property integer $id_pendidikan_ibu
 * @property integer $id_pekerjaan_ibu
 * @property integer $id_penghasilan_orangtua_perbulan
 * @property string $alamat_lengkap_orang_tua
 * @property integer $id_area_kelurahan_orang_tua
 * @property integer $kode_pos_orangtua
 * @property integer $jarak_rumah_kesekolah
 * @property integer $id_alat_transport_orangtua
 * @property string $nama_wali
 * @property string $no_telp_wali
 * @property string $hubungan_dengan_wali
 * @property integer $id_pekerjaan_wali
 * @property string $no_kks_kps
 * @property string $no_kartu_pkh
 * @property string $no_kip
 * @property string $kebutuhan_tuna_rungu
 * @property string $kebutuhan_tuna_daksa
 * @property string $kebutuhan_tuna_laras
 * @property string $kebutuhan_tuna_belajar
 * @property string $kebutuhan_tuna_grahita
 * @property string $kebutuhan_tuna_netra
 * @property string $kebutuhan_lamban_belajar
 * @property string $kebutuhan_sulit_belajar
 * @property string $kebutuhan_bakat_luar_biasa
 * @property string $kebutuhan_gangguan_komunikasi
 * @property integer $status_siswa
 * @property integer $create_by
 * @property string $create_at
 * @property string $update_at
 *
 * @property AlatTransport $idTransportasiKesekolah
 * @property User $createBy
 * @property Pekerjaan $idPekerjaanAyah
 * @property JenjangPendidikan $idPendidikanAyah
 * @property JenjangPendidikan $idPendidikanIbu
 * @property Pekerjaan $idPekerjaanIbu
 * @property Penghasilan $idPenghasilanOrangtuaPerbulan
 * @property Area $idAreaKelurahanOrangTua
 * @property AlatTransport $idAlatTransportOrangtua
 * @property Pekerjaan $idPekerjaanWali
 * @property RelasiKelasSiswa[] $relasiKelasSiswas
 * @property StafBuatSurat[] $stafBuatSurats
 */
class DataSiswa extends \yii\db\ActiveRecord
{
    public $sekolah;
    public $kelas;
    public $help_foto;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data_siswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_siswa', 'nis_siswa', 'nama_siswa', 'jenis_kelamin_siswa', 'tempat_lahir_siswa', 'tanggal_lahir_siswa','alamat_domisili', 'no_telp_orangtua', 'nama_ayah', 'nama_ibu', 'status_siswa', 'sekolah', 'kelas'], 'required'],
            [['jenis_kelamin_siswa', 'jumlah_saudara_siswa', 'tinggi_badan_siswa', 'berat_badan_siswa', 'jenis_tempat_tinggal', 'jarak_domisili_kesekolah', 'id_transportasi_kesekolah', 'no_kk', 'no_ktp_ayah', 'id_pendidikan_ayah', 'id_pekerjaan_ayah', 'no_ktp_ibu', 'id_pendidikan_ibu', 'id_pekerjaan_ibu', 'id_penghasilan_orangtua_perbulan', 'id_area_kelurahan_orang_tua', 'kode_pos_orangtua', 'jarak_rumah_kesekolah', 'id_alat_transport_orangtua', 'id_pekerjaan_wali', 'status_siswa', 'create_by'], 'integer'],
            [['tanggal_lahir_siswa', 'create_at', 'update_at'], 'safe'],
            [['uid_siswa'], 'string', 'max' => 25],
            [['help_foto'], 'file', 'skipOnEmpty' => true, 'extensions'=>'jpg, jpeg, png, gif'],
           // ['help_foto', 'required', 'on' => 'create'],
            [['nis_siswa', 'no_kks_kps', 'no_kartu_pkh', 'no_kip'], 'string', 'max' => 20],
            [['nisn_siswa'], 'string', 'max' => 10],
            [['nik_siswa'], 'string', 'max' => 16],
            [['nama_siswa', 'tempat_lahir_siswa', 'nama_ayah', 'nama_ibu', 'alamat_lengkap_orang_tua', 'hubungan_dengan_wali', 'kebutuhan_tuna_rungu', 'kebutuhan_tuna_daksa', 'kebutuhan_tuna_laras', 'kebutuhan_tuna_belajar', 'kebutuhan_tuna_grahita', 'kebutuhan_tuna_netra', 'kebutuhan_lamban_belajar', 'kebutuhan_sulit_belajar', 'kebutuhan_bakat_luar_biasa', 'kebutuhan_gangguan_komunikasi'], 'string', 'max' => 100],
            [['hobi_siswa', 'gdrive_pasfoto_siswa', 'alamat_domisili'], 'string', 'max' => 255],
            [['cita_cita_siswa', 'nama_wali'], 'string', 'max' => 50],
            [['no_telp_orangtua', 'no_telp_wali'], 'string', 'max' => 12],
            [['nis_siswa'], 'unique'],
            [['nisn_siswa'], 'unique'],
            [['nik_siswa'], 'unique'],
            [['id_transportasi_kesekolah'], 'exist', 'skipOnError' => true, 'targetClass' => AlatTransport::className(), 'targetAttribute' => ['id_transportasi_kesekolah' => 'id_alat_transport']],
            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
            [['id_pekerjaan_ayah'], 'exist', 'skipOnError' => true, 'targetClass' => Pekerjaan::className(), 'targetAttribute' => ['id_pekerjaan_ayah' => 'id_pekerjaan']],
            [['id_pendidikan_ayah'], 'exist', 'skipOnError' => true, 'targetClass' => JenjangPendidikan::className(), 'targetAttribute' => ['id_pendidikan_ayah' => 'id_jenj_didik']],
            [['id_pendidikan_ibu'], 'exist', 'skipOnError' => true, 'targetClass' => JenjangPendidikan::className(), 'targetAttribute' => ['id_pendidikan_ibu' => 'id_jenj_didik']],
            [['id_pekerjaan_ibu'], 'exist', 'skipOnError' => true, 'targetClass' => Pekerjaan::className(), 'targetAttribute' => ['id_pekerjaan_ibu' => 'id_pekerjaan']],
            [['id_penghasilan_orangtua_perbulan'], 'exist', 'skipOnError' => true, 'targetClass' => Penghasilan::className(), 'targetAttribute' => ['id_penghasilan_orangtua_perbulan' => 'id_penghasilan']],
            [['id_area_kelurahan_orang_tua'], 'exist', 'skipOnError' => true, 'targetClass' => Area::className(), 'targetAttribute' => ['id_area_kelurahan_orang_tua' => 'id_area']],
            [['id_alat_transport_orangtua'], 'exist', 'skipOnError' => true, 'targetClass' => AlatTransport::className(), 'targetAttribute' => ['id_alat_transport_orangtua' => 'id_alat_transport']],
            [['id_pekerjaan_wali'], 'exist', 'skipOnError' => true, 'targetClass' => Pekerjaan::className(), 'targetAttribute' => ['id_pekerjaan_wali' => 'id_pekerjaan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid_siswa' => 'Uid Siswa',
            'sekolah'=> 'Nama Sekolah',
            'nis_siswa' => 'Nis Siswa',
            'nisn_siswa' => 'Nisn Siswa',
            'nik_siswa' => 'Nik Siswa',
            'nama_siswa' => 'Nama Siswa',
            'help_foto' => 'Pas Foto Siswa',
            'jenis_kelamin_siswa' => 'Jenis Kelamin Siswa',
            'tempat_lahir_siswa' => 'Tempat Lahir Siswa',
            'tanggal_lahir_siswa' => 'Tanggal Lahir Siswa',
            'hobi_siswa' => 'Hobi Siswa',
            'cita_cita_siswa' => 'Cita Cita Siswa',
            'gdrive_pasfoto_siswa' => 'Gdrive Pasfoto Siswa',
            'jumlah_saudara_siswa' => 'Jumlah Saudara Siswa',
            'tinggi_badan_siswa' => 'Tinggi Badan Siswa',
            'berat_badan_siswa' => 'Berat Badan Siswa',
            'jenis_tempat_tinggal' => 'Jenis Tempat Tinggal',
            'alamat_domisili' => 'Alamat Domisili',
            'jarak_domisili_kesekolah' => 'Jarak Domisili Kesekolah',
            'id_transportasi_kesekolah' => 'Id Transportasi Kesekolah',
            'no_kk' => 'No Kk',
            'no_telp_orangtua' => 'No Telp Orangtua',
            'nama_ayah' => 'Nama Ayah',
            'no_ktp_ayah' => 'No Ktp Ayah',
            'id_pendidikan_ayah' => 'Id Pendidikan Ayah',
            'id_pekerjaan_ayah' => 'Id Pekerjaan Ayah',
            'nama_ibu' => 'Nama Ibu',
            'no_ktp_ibu' => 'No Ktp Ibu',
            'id_pendidikan_ibu' => 'Id Pendidikan Ibu',
            'id_pekerjaan_ibu' => 'Id Pekerjaan Ibu',
            'id_penghasilan_orangtua_perbulan' => 'Id Penghasilan Orangtua Perbulan',
            'alamat_lengkap_orang_tua' => 'Alamat Lengkap Orang Tua',
            'id_area_kelurahan_orang_tua' => 'Id Area Kelurahan Orang Tua',
            'kode_pos_orangtua' => 'Kode Pos Orangtua',
            'jarak_rumah_kesekolah' => 'Jarak Rumah Kesekolah',
            'id_alat_transport_orangtua' => 'Id Alat Transport Orangtua',
            'nama_wali' => 'Nama Wali',
            'no_telp_wali' => 'No Telp Wali',
            'hubungan_dengan_wali' => 'Hubungan Dengan Wali',
            'id_pekerjaan_wali' => 'Id Pekerjaan Wali',
            'no_kks_kps' => 'No Kks Kps',
            'no_kartu_pkh' => 'No Kartu Pkh',
            'no_kip' => 'No Kip',
            'kebutuhan_tuna_rungu' => 'Kebutuhan Tuna Rungu',
            'kebutuhan_tuna_daksa' => 'Kebutuhan Tuna Daksa',
            'kebutuhan_tuna_laras' => 'Kebutuhan Tuna Laras',
            'kebutuhan_tuna_belajar' => 'Kebutuhan Tuna Belajar',
            'kebutuhan_tuna_grahita' => 'Kebutuhan Tuna Grahita',
            'kebutuhan_tuna_netra' => 'Kebutuhan Tuna Netra',
            'kebutuhan_lamban_belajar' => 'Kebutuhan Lamban Belajar',
            'kebutuhan_sulit_belajar' => 'Kebutuhan Sulit Belajar',
            'kebutuhan_bakat_luar_biasa' => 'Kebutuhan Bakat Luar Biasa',
            'kebutuhan_gangguan_komunikasi' => 'Kebutuhan Gangguan Komunikasi',
            'status_siswa' => 'Status Siswa',
            'create_by' => 'Create By',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTransportasiKesekolah()
    {
        return $this->hasOne(AlatTransport::className(), ['id_alat_transport' => 'id_transportasi_kesekolah']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'create_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPekerjaanAyah()
    {
        return $this->hasOne(Pekerjaan::className(), ['id_pekerjaan' => 'id_pekerjaan_ayah']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPendidikanAyah()
    {
        return $this->hasOne(JenjangPendidikan::className(), ['id_jenj_didik' => 'id_pendidikan_ayah']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPendidikanIbu()
    {
        return $this->hasOne(JenjangPendidikan::className(), ['id_jenj_didik' => 'id_pendidikan_ibu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPekerjaanIbu()
    {
        return $this->hasOne(Pekerjaan::className(), ['id_pekerjaan' => 'id_pekerjaan_ibu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPenghasilanOrangtuaPerbulan()
    {
        return $this->hasOne(Penghasilan::className(), ['id_penghasilan' => 'id_penghasilan_orangtua_perbulan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAreaKelurahanOrangTua()
    {
        return $this->hasOne(Area::className(), ['id_area' => 'id_area_kelurahan_orang_tua']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAlatTransportOrangtua()
    {
        return $this->hasOne(AlatTransport::className(), ['id_alat_transport' => 'id_alat_transport_orangtua']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPekerjaanWali()
    {
        return $this->hasOne(Pekerjaan::className(), ['id_pekerjaan' => 'id_pekerjaan_wali']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelasiKelasSiswas()
    {
        return $this->hasMany(RelasiKelasSiswa::className(), ['uid_data_siswa' => 'uid_siswa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStafBuatSurats()
    {
        return $this->hasMany(StafBuatSurat::className(), ['uid_data_siswa' => 'uid_siswa']);
    }
}
