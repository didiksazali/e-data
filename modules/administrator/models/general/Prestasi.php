<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "prestasi".
 *
 * @property integer $id_prestasi
 * @property integer $id_anggota
 * @property string $nama_prestasi
 * @property string $tingkat_prestasi
 * @property string $sertifikat_prestasi
 *
 * @property Anggota[] $anggotas
 */
class Prestasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prestasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_prestasi', 'id_anggota', 'nama_prestasi', 'tingkat_prestasi', 'sertifikat_prestasi'], 'required'],
            [['id_prestasi', 'id_anggota'], 'integer'],
            [['nama_prestasi', 'sertifikat_prestasi'], 'string', 'max' => 255],
            [['tingkat_prestasi'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_prestasi' => 'Id Prestasi',
            'id_anggota' => 'Id Anggota',
            'nama_prestasi' => 'Nama Prestasi',
            'tingkat_prestasi' => 'Tingkat Prestasi',
            'sertifikat_prestasi' => 'Sertifikat Prestasi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnggotas()
    {
        return $this->hasMany(Anggota::className(), ['id_prestasi' => 'id_prestasi']);
    }
}
