<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "staf_surat_masuk".
 *
 * @property string $uid_surat_masuk
 * @property string $no_surat
 * @property string $tanggal_masuk
 * @property string $dari
 * @property string $id_google_drive
 * @property string $tujuan_surat_kesekolah
 * @property string $maksud_surat
 * @property string $uid_kategori_surat
 * @property string $tags_surat
 * @property string $tindakan_yang_harus_dilakukan
 * @property string $beban_kerja_kepada
 * @property string $estimasi_batas_tindakan
 * @property integer $create_by
 * @property string $create_at
 * @property string $update_at
 *
 * @property User $createBy
 * @property StafKategoriSurat $uidKategoriSurat
 * @property Staf $bebanKerjaKepada
 * @property DmSekolah $tujuanSuratKesekolah
 */
class StafSuratMasuk extends \yii\db\ActiveRecord
{

    public $document_scan;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staf_surat_masuk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_surat_masuk', 'no_surat', 'tanggal_masuk', 'dari', 'id_google_drive', 'tujuan_surat_kesekolah', 'maksud_surat', 'uid_kategori_surat', 'tags_surat', 'create_by'], 'required'],
            [['tanggal_masuk', 'estimasi_batas_tindakan', 'create_at', 'update_at'], 'safe'],
            [['tindakan_yang_harus_dilakukan'], 'string'],
            [['document_scan'], 'file', 'skipOnEmpty' => true, 'extensions'=>'jpeg, jpg, png, gif'],
            ['document_scan', 'required', 'on' => 'create'],
            [['create_by'], 'integer'],
            [['uid_surat_masuk', 'tujuan_surat_kesekolah', 'uid_kategori_surat', 'beban_kerja_kepada'], 'string', 'max' => 25],
            [['no_surat', 'id_google_drive', 'maksud_surat', 'tags_surat'], 'string', 'max' => 255],
            [['dari'], 'string', 'max' => 100],


            ['tindakan_yang_harus_dilakukan', 'required', 'when' => function ($model) {
                // return $model->check_helper == 1;
            }, 'whenClient' => "function (attribute, value) {
                return $('#tindakanLanjut').val() == 1;
            }"],

            ['estimasi_batas_tindakan', 'required', 'when' => function ($model) {
                // return $model->check_helper == 1;
            }, 'whenClient' => "function (attribute, value) {
                return $('#tindakanLanjut').val() == 1;
            }"],


            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
            [['uid_kategori_surat'], 'exist', 'skipOnError' => true, 'targetClass' => StafKategoriSurat::className(), 'targetAttribute' => ['uid_kategori_surat' => 'uid_kategori_surat']],
            [['beban_kerja_kepada'], 'exist', 'skipOnError' => true, 'targetClass' => Staf::className(), 'targetAttribute' => ['beban_kerja_kepada' => 'uid_staf']],
            [['tujuan_surat_kesekolah'], 'exist', 'skipOnError' => true, 'targetClass' => DmSekolah::className(), 'targetAttribute' => ['tujuan_surat_kesekolah' => 'uid_dm_sekolah']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid_surat_masuk' => 'Uid Surat Masuk',
            'no_surat' => 'No Surat',
            'tanggal_masuk' => 'Tgl Masuk',
            'dari' => 'Dari',
            'id_google_drive' => 'Id Google Drive',
            'tujuan_surat_kesekolah' => 'Tujuan',
            'maksud_surat' => 'Maksud',
            'uid_kategori_surat' => 'Kategori',
            'tags_surat' => 'Tags Surat',
            'tindakan_yang_harus_dilakukan' => 'Tindakan Yang Harus Dilakukan',
            'beban_kerja_kepada' => 'Beban Kerja Kepada',
            'estimasi_batas_tindakan' => 'Estimasi Batas Tindakan',
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
    public function getUidKategoriSurat()
    {
        return $this->hasOne(StafKategoriSurat::className(), ['uid_kategori_surat' => 'uid_kategori_surat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBebanKerjaKepada()
    {
        return $this->hasOne(Staf::className(), ['uid_staf' => 'beban_kerja_kepada']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTujuanSuratKesekolah()
    {
        return $this->hasOne(DmSekolah::className(), ['uid_dm_sekolah' => 'tujuan_surat_kesekolah']);
    }
}


