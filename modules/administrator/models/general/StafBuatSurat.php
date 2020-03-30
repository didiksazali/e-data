<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "staf_buat_surat".
 *
 * @property string $uid_buat_surat
 * @property integer $no_urut
 * @property string $no_surat
 * @property string $uid_jenis_surat
 * @property string $uid_data_siswa
 * @property string $estimasi_selesai_tanggal
 * @property integer $biaya_optional
 * @property string $attribute_tambahan_optional
 * @property integer $create_by
 * @property string $create_at
 * @property string $update_at
 *
 * @property StafJenisSurat $uidJenisSurat
 * @property DataSiswa $uidDataSiswa
 * @property User $createBy
 */
class StafBuatSurat extends \yii\db\ActiveRecord
{
    public $sekolah;
    public $help_upload_scan;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staf_buat_surat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_buat_surat', 'no_urut', 'no_surat', 'uid_jenis_surat', 'uid_data_siswa', 'estimasi_selesai_tanggal', 'biaya_optional', 'create_by'], 'required'],
            [['no_urut', 'biaya_optional', 'status_selesai', 'create_by'], 'integer'],
            [['estimasi_selesai_tanggal', 'create_at', 'update_at', 'gdrive_scan_document'], 'safe'],
            [['attribute_tambahan_optional'], 'string'],
            [['uid_buat_surat', 'uid_jenis_surat', 'uid_data_siswa'], 'string', 'max' => 25],
            [['gdrive_scan_document'], 'string', 'max' => 100],
            [['help_upload_scan'], 'file', 'skipOnEmpty' => true, 'extensions'=>'jpg, jpeg, png, gif'],
            ['help_upload_scan', 'required', 'on' => 'tandai_selesai'],
            ['sekolah', 'required', 'on' => 'create'],
            ['sekolah', 'required', 'on' => 'update'],
            ['tanggal_selesai', 'required', 'on' => 'tandai_selesai'],
            [['uid_jenis_surat'], 'exist', 'skipOnError' => true, 'targetClass' => StafJenisSurat::className(), 'targetAttribute' => ['uid_jenis_surat' => 'uid_jenis_surat']],
            [['uid_data_siswa'], 'exist', 'skipOnError' => true, 'targetClass' => DataSiswa::className(), 'targetAttribute' => ['uid_data_siswa' => 'uid_siswa']],
            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid_buat_surat' => 'Uid Buat Surat',
            'no_urut' => 'No Urut',
            'no_surat' => 'No Surat',
            'tanggal_selesai' => 'Tgl Selesai',
            'sekolah'=> 'Nama Sekolah',
            'uid_jenis_surat' => 'Jenis Surat',
            'uid_data_siswa' => 'Siswa',
            'estimasi_selesai_tanggal' => 'Estimasi Selesai',
            'biaya_optional' => 'Biaya Pembuatan (Rp.)',
            'attribute_tambahan_optional' => 'Attribute Tambahan Optional',
            'status_selesai'=> 'Status',
            'help_upload_scan'=> 'Upload Scan',
            'create_by' => 'Create By',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUidJenisSurat()
    {
        return $this->hasOne(StafJenisSurat::className(), ['uid_jenis_surat' => 'uid_jenis_surat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUidDataSiswa()
    {
        return $this->hasOne(DataSiswa::className(), ['uid_siswa' => 'uid_data_siswa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'create_by']);
    }
}
