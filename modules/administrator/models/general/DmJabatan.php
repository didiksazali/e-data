<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "dm_jabatan".
 *
 * @property string $kode_jabatan
 * @property string $nama_jabatan
 * @property string $deskripsi_jabatan
 * @property integer $create_by
 * @property string $create_at
 * @property string $update_at
 *
 * @property User $createBy
 * @property Staf[] $stafs
 */
class DmJabatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dm_jabatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_jabatan', 'nama_jabatan', 'deskripsi_jabatan', 'create_by'], 'required'],
            [['create_by'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['kode_jabatan'], 'string', 'max' => 10],
            [['nama_jabatan'], 'string', 'max' => 100],
            [['deskripsi_jabatan'], 'string', 'max' => 255],
            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode_jabatan' => 'Kode Jabatan',
            'nama_jabatan' => 'Nama Jabatan',
            'deskripsi_jabatan' => 'Deskripsi Jabatan',
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
    public function getStafs()
    {
        return $this->hasMany(Staf::className(), ['jabatan' => 'kode_jabatan']);
    }
}
