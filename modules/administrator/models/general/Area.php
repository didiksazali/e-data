<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "area".
 *
 * @property integer $id_area
 * @property string $idprov
 * @property string $idkot
 * @property string $idkec
 * @property string $idkel
 * @property string $nama_tempat
 * @property string $level
 *
 * @property Anggota[] $anggotas
 * @property Anggota[] $anggotas0
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idprov', 'idkot', 'idkec', 'idkel', 'nama_tempat', 'level'], 'required'],
            [['idprov', 'idkot'], 'string', 'max' => 2],
            [['idkec', 'idkel'], 'string', 'max' => 3],
            [['nama_tempat'], 'string', 'max' => 50],
            [['level'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_area' => 'Id Area',
            'idprov' => 'Idprov',
            'idkot' => 'Idkot',
            'idkec' => 'Idkec',
            'idkel' => 'Idkel',
            'nama_tempat' => 'Nama Tempat',
            'level' => 'Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnggotas()
    {
        return $this->hasMany(Anggota::className(), ['alamat_kampung_kelurahan' => 'id_area']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnggotas0()
    {
        return $this->hasMany(Anggota::className(), ['alamat_sekarang_kelurahan' => 'id_area']);
    }
}
