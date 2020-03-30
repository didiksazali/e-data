<?php

namespace app\modules\administrator\models\general;

use Yii;
use yii\helpers\Url;


/**
 * This is the model class for table "anggota".
 *
 * @property integer $id_anggota
 * @property string $no_ktp
 * @property integer $no_id_pkdp
 * @property string $nama
 * @property integer $alamat_sekarang_kelurahan
 * @property string $alamat_sekarang_lengkap
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $jk
 * @property string $no_hp
 * @property string $email
 * @property string $pekerjaan
 * @property integer $id_pendidikan
 * @property integer $id_dpw
 * @property integer $id_dpd
 * @property integer $id_dpc
 * @property integer $alamat_kampung_kelurahan
 * @property string $alamat_kampung_lengkap
 * @property integer $id_penghasilan
 * @property string $prestasi
 * @property string $motivasi_bergabung
 * @property string $masukan_untuk_ranah
 * @property string $masukan_untuk_rantau
 * @property string $foto
 * @property string $kk
 *
 * @property Dpc $idDpc
 * @property Pendidikan $idPendidikan
 * @property Dpd $idDpd
 * @property Dpw $idDpw
 * @property Penghasilan $idPenghasilan
 * @property Area $alamatKampungKelurahan
 * @property Area $alamatSekarangKelurahan
 */
class Anggota extends \yii\db\ActiveRecord
{
    public $fotoHelper;
    public $kkHelper;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'anggota';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['no_ktp', 'no_id_pkdp', 'nama', 'alamat_sekarang', 'tempat_lahir', 'tanggal_lahir', 'jk', 'no_hp', 'email', 'pekerjaan', 'id_pendidikan', 'dpw', 'dpd', 'dpc', 'alamat_kampung', 'id_penghasilan', 'prestasi', 'motivasi_bergabung', 'masukan_untuk_ranah', 'masukan_untuk_rantau', 'foto', 'kk'], 'required'],
            [['no_id_pkdp', 'id_pendidikan', 'id_penghasilan'], 'integer'],
            [['tanggal_lahir'], 'safe'],
            [['no_ktp'], 'string', 'max' => 16],
            [['nama', 'tempat_lahir', 'email'], 'string', 'max' => 100],
            [['alamat_sekarang', 'alamat_kampung', 'prestasi', 'motivasi_bergabung', 'masukan_untuk_ranah', 'masukan_untuk_rantau'], 'string', 'max' => 255],
            [['jk'], 'string', 'max' => 1],
            [['no_hp', 'dpw', 'dpd', 'dpc'], 'string', 'max' => 25],
            [['pekerjaan'], 'string', 'max' => 50],
            [['no_ktp'], 'unique'],
            [['no_id_pkdp'], 'unique'],
            [['id_pendidikan'], 'exist', 'skipOnError' => true, 'targetClass' => Pendidikan::className(), 'targetAttribute' => ['id_pendidikan' => 'id_pendidikan']],
            [['id_penghasilan'], 'exist', 'skipOnError' => true, 'targetClass' => Penghasilan::className(), 'targetAttribute' => ['id_penghasilan' => 'id_penghasilan']],
            [['fotoHelper','kkHelper'],'file','skipOnEmpty'=>true,'extensions'=>'jpg, jpeg, png'],
            [['fotoHelper','kkHelper'],'required','on' => 'create'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fotoHelper' => 'Foto',
            'kkHelper' => 'KK',
            'id_anggota' => 'Id Anggota',
            'no_ktp' => 'No KTP',
            'no_id_pkdp' => 'No ID PKDP',
            'nama' => 'Nama',
            'alamat_sekarang' => 'Alamat Sekarang',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jk' => 'Jenis Kelamin',
            'no_hp' => 'No Hp',
            'email' => 'Email',
            'pekerjaan' => 'Pekerjaan',
            'id_pendidikan' => 'Pendidikan',
            'dpw' => 'DPW',
            'dpd' => 'DPD',
            'dpc' => 'DPC',
            'alamat_kampung' => 'Alamat Kampung',
            'id_penghasilan' => 'Penghasilan',
            'prestasi' => 'Prestasi',
            'motivasi_bergabung' => 'Motivasi Bergabung',
            'masukan_untuk_ranah' => 'Masukan Untuk Ranah',
            'masukan_untuk_rantau' => 'Masukan Untuk Rantau',
            'foto' => 'Foto',
            'kk' => 'KK',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPendidikan()
    {
        return $this->hasOne(Pendidikan::className(), ['id_pendidikan' => 'id_pendidikan']);
    }




    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPenghasilan()
    {
        return $this->hasOne(Penghasilan::className(), ['id_penghasilan' => 'id_penghasilan']);
    }




}
