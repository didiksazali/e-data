<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "dm_sekolah".
 *
 * @property string $uid_dm_sekolah
 * @property integer $npsn
 * @property string $nss_nsm
 * @property string $jenjang_sekolah
 * @property string $nama
 * @property string $alamat
 * @property integer $kode_pos
 * @property string $status
 * @property string $akreditas
 * @property string $logo
 * @property string $no_telp
 * @property string $fax
 * @property string $email
 * @property string $tagline
 * @property string $visi
 * @property string $misi
 * @property integer $create_by
 * @property string $create_at
 * @property string $update_at
 *
 * @property User $createBy
 * @property JurusanSekolah[] $jurusanSekolahs
 * @property Kelas[] $kelas
 * @property StafSuratMasuk[] $stafSuratMasuks
 * @property StafTemplateSurat[] $stafTemplateSurats
 */
class DmSekolah extends \yii\db\ActiveRecord
{
    public $logo_helper;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dm_sekolah';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_dm_sekolah', 'npsn', 'jenjang_sekolah', 'nama', 'alamat', 'status', 'akreditas', 'logo', 'no_telp', 'email', 'tagline', 'visi', 'misi', 'create_by'], 'required'],
            [['npsn', 'kode_pos', 'create_by'], 'integer'],
            [['logo_helper'], 'file', 'skipOnEmpty' => true, 'extensions'=>'png, jpg, gif'],
            ['logo_helper', 'required', 'on' => 'create'],
            [['jenjang_sekolah', 'status', 'visi', 'misi'], 'string'],
            [['create_at', 'update_at'], 'safe'],
            [['uid_dm_sekolah'], 'string', 'max' => 25],
            [['nss_nsm'], 'string', 'max' => 16],
            [['nama', 'email'], 'string', 'max' => 100],
            [['alamat', 'logo', 'tagline'], 'string', 'max' => 255],
            [['akreditas'], 'string', 'max' => 1],
            [['no_telp', 'fax'], 'string', 'max' => 12],
            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid_dm_sekolah' => 'Uid Dm Sekolah',
            'npsn' => 'Npsn',
            'nss_nsm' => 'Nss Nsm',
            'jenjang_sekolah' => 'Jenjang Sekolah',
            'logo_helper'=>'Upload Logo',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'kode_pos' => 'Kode Pos',
            'status' => 'Status',
            'akreditas' => 'Akreditas',
            'logo' => 'Logo',
            'no_telp' => 'No Telp',
            'fax' => 'Fax',
            'email' => 'Email',
            'tagline' => 'Tagline',
            'visi' => 'Visi',
            'misi' => 'Misi',
            'create_by' => 'Create By',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
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
    public function getJurusanSekolahs()
    {
        return $this->hasMany(JurusanSekolah::className(), ['uid_dm_sekolah' => 'uid_dm_sekolah']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasMany(Kelas::className(), ['uid_sekolah' => 'uid_dm_sekolah']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStafSuratMasuks()
    {
        return $this->hasMany(StafSuratMasuk::className(), ['tujuan_surat_kesekolah' => 'uid_dm_sekolah']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStafTemplateSurats()
    {
        return $this->hasMany(StafTemplateSurat::className(), ['uid_untuk_sekolah' => 'uid_dm_sekolah']);
    }
}
