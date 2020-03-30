<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "relasi_kelas_siswa".
 *
 * @property integer $id_relasi_kelas_siswa
 * @property string $uid_data_siswa
 * @property string $uid_kelas
 * @property string $uid_tahun_ajaran
 * @property string $keterangan
 * @property integer $create_by
 * @property string $create_at
 * @property string $update_at
 *
 * @property Kelas $uidKelas
 * @property TahunAjaran $uidTahunAjaran
 * @property User $createBy
 * @property DataSiswa $uidDataSiswa
 */
class RelasiKelasSiswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relasi_kelas_siswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_data_siswa', 'uid_kelas', 'uid_tahun_ajaran', 'keterangan', 'create_by'], 'required'],
            [['create_by'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['uid_data_siswa', 'uid_kelas', 'uid_tahun_ajaran'], 'string', 'max' => 25],
            [['keterangan'], 'string', 'max' => 100],
            [['uid_kelas'], 'exist', 'skipOnError' => true, 'targetClass' => Kelas::className(), 'targetAttribute' => ['uid_kelas' => 'uid_kelas']],
            [['uid_tahun_ajaran'], 'exist', 'skipOnError' => true, 'targetClass' => TahunAjaran::className(), 'targetAttribute' => ['uid_tahun_ajaran' => 'uid_thn_ajaran']],
            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
            [['uid_data_siswa'], 'exist', 'skipOnError' => true, 'targetClass' => DataSiswa::className(), 'targetAttribute' => ['uid_data_siswa' => 'uid_siswa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_relasi_kelas_siswa' => 'Id Relasi Kelas Siswa',
            'uid_data_siswa' => 'Uid Data Siswa',
            'uid_kelas' => 'Uid Kelas',
            'uid_tahun_ajaran' => 'Uid Tahun Ajaran',
            'keterangan' => 'Keterangan',
            'create_by' => 'Create By',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUidKelas()
    {
        return $this->hasOne(Kelas::className(), ['uid_kelas' => 'uid_kelas']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUidTahunAjaran()
    {
        return $this->hasOne(TahunAjaran::className(), ['uid_thn_ajaran' => 'uid_tahun_ajaran']);
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
    public function getUidDataSiswa()
    {
        return $this->hasOne(DataSiswa::className(), ['uid_siswa' => 'uid_data_siswa']);
    }
}
