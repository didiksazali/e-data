<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "jurusan_sekolah".
 *
 * @property string $uid_jurusan
 * @property string $uid_dm_sekolah
 * @property string $nama_jurusan
 * @property string $deskripsi_jurusan
 * @property integer $create_by
 * @property string $create_at
 * @property string $update_at
 *
 * @property User $createBy
 * @property DmSekolah $uidDmSekolah
 */
class JurusanSekolah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jurusan_sekolah';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_jurusan', 'uid_dm_sekolah', 'nama_jurusan', 'deskripsi_jurusan', 'create_by'], 'required'],
            [['create_by'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['uid_jurusan', 'uid_dm_sekolah'], 'string', 'max' => 25],
            [['nama_jurusan'], 'string', 'max' => 100],
            [['deskripsi_jurusan'], 'string', 'max' => 255],
            [['nama_jurusan'], 'unique'],
            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
            [['uid_dm_sekolah'], 'exist', 'skipOnError' => true, 'targetClass' => DmSekolah::className(), 'targetAttribute' => ['uid_dm_sekolah' => 'uid_dm_sekolah']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid_jurusan' => 'Uid Jurusan',
            'uid_dm_sekolah' => 'Uid Dm Sekolah',
            'nama_jurusan' => 'Nama Jurusan',
            'deskripsi_jurusan' => 'Deskripsi Jurusan',
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
    public function getUidDmSekolah()
    {
        return $this->hasOne(DmSekolah::className(), ['uid_dm_sekolah' => 'uid_dm_sekolah']);
    }
}
