<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "kelas".
 *
 * @property string $uid_kelas
 * @property string $uid_sekolah
 * @property string $kode_kelas
 * @property string $nama_kelas
 * @property string $ruangan_kelas
 * @property integer $create_by
 * @property string $create_at
 * @property string $update_at
 *
 * @property DmSekolah $uidSekolah
 * @property User $createBy
 * @property RelasiKelasSiswa[] $relasiKelasSiswas
 */
class Kelas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kelas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_kelas', 'uid_sekolah', 'kode_kelas', 'nama_kelas', 'ruangan_kelas', 'create_by'], 'required'],
            [['create_by'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['uid_kelas', 'uid_sekolah', 'nama_kelas'], 'string', 'max' => 25],
            [['kode_kelas', 'ruangan_kelas'], 'string', 'max' => 10],
            [['kode_kelas'], 'unique'],
            [['nama_kelas'], 'unique'],
            [['uid_sekolah'], 'exist', 'skipOnError' => true, 'targetClass' => DmSekolah::className(), 'targetAttribute' => ['uid_sekolah' => 'uid_dm_sekolah']],
            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid_kelas' => 'Uid Kelas',
            'uid_sekolah' => 'Nama Sekolah',
            'kode_kelas' => 'Kode Kelas',
            'nama_kelas' => 'Nama Kelas',
            'ruangan_kelas' => 'Ruangan Kelas',
            'create_by' => 'Create By',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUidSekolah()
    {
        return $this->hasOne(DmSekolah::className(), ['uid_dm_sekolah' => 'uid_sekolah']);
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
    public function getRelasiKelasSiswas()
    {
        return $this->hasMany(RelasiKelasSiswa::className(), ['uid_kelas' => 'uid_kelas']);
    }
}
