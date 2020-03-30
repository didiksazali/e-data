<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "staf_jenis_surat".
 *
 * @property string $uid_jenis_surat
 * @property string $nama_jenis_surat
 * @property string $uid_template_surat
 * @property integer $estimasi_selesai
 * @property integer $biaya
 * @property string $no_surat
 * @property string $default_attribute_tambahan
 * @property integer $status
 * @property integer $create_by
 * @property string $create_at
 * @property string $update_by
 *
 * @property StafBuatSurat[] $stafBuatSurats
 * @property StafTemplateSurat $uidTemplateSurat
 * @property User $createBy
 */
class StafJenisSurat extends \yii\db\ActiveRecord
{
    public $help_sekolah;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staf_jenis_surat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_jenis_surat', 'help_sekolah', 'nama_jenis_surat', 'uid_template_surat', 'estimasi_selesai', 'biaya', 'no_surat', 'status', 'create_by'], 'required'],
            [['estimasi_selesai', 'biaya', 'status', 'create_by'], 'integer'],
            [['default_attribute_tambahan'], 'string'],
            [['create_at', 'update_by', 'no_surat_terakhir'], 'safe'],
            [['uid_jenis_surat'], 'string', 'max' => 25],
            [['nama_jenis_surat', 'no_surat'], 'string', 'max' => 100],
            [['uid_template_surat'], 'string', 'max' => 255],
            [['uid_template_surat'], 'exist', 'skipOnError' => true, 'targetClass' => StafTemplateSurat::className(), 'targetAttribute' => ['uid_template_surat' => 'uid_template_surat']],
            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid_jenis_surat' => 'Uid Jenis Surat',
            'nama_jenis_surat' => 'Nama Jenis Surat',
            'uid_template_surat' => 'Nama Template Surat',
            'estimasi_selesai' => 'Estimasi Selesai',
            'biaya' => 'Biaya',
            'nomor_surat_terakhir'=> 'Nomor Urut Surat Terakhir',
            'no_surat' => 'No Surat',
            'default_attribute_tambahan' => 'Default Attribute Tambahan',
            'status' => 'Status',
            'create_by' => 'Create By',
            'create_at' => 'Create At',
            'update_by' => 'Update By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStafBuatSurats()
    {
        return $this->hasMany(StafBuatSurat::className(), ['uid_jenis_surat' => 'uid_jenis_surat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUidTemplateSurat()
    {
        return $this->hasOne(StafTemplateSurat::className(), ['uid_template_surat' => 'uid_template_surat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'create_by']);
    }
}
