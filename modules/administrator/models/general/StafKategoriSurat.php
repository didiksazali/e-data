<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "staf_kategori_surat".
 *
 * @property string $uid_kategori_surat
 * @property string $nama_kategori
 * @property string $dekripsi
 * @property integer $create_by
 * @property string $create_at
 * @property string $update_at
 *
 * @property User $createBy
 * @property StafSuratMasuk[] $stafSuratMasuks
 */
class StafKategoriSurat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staf_kategori_surat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_kategori_surat', 'nama_kategori', 'create_by'], 'required'],
            [['create_by'], 'integer'],
            [['nama_kategori'], 'unique'],
            [['create_at', 'update_at'], 'safe'],
            [['uid_kategori_surat'], 'string', 'max' => 25],
            [['nama_kategori'], 'string', 'max' => 100],
            [['dekripsi'], 'string', 'max' => 255],
            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid_kategori_surat' => 'Uid Kategori Surat',
            'nama_kategori' => 'Nama Kategori',
            'dekripsi' => 'Dekripsi',
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
    public function getStafSuratMasuks()
    {
        return $this->hasMany(StafSuratMasuk::className(), ['uid_kategori_surat' => 'uid_kategori_surat']);
    }
}
