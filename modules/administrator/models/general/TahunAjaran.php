<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "tahun_ajaran".
 *
 * @property string $uid_thn_ajaran
 * @property string $kode_tahun_ajaran
 * @property string $nama
 * @property string $tanggal_mulai
 * @property string $tanggal_selesai
 * @property integer $status
 * @property integer $create_by
 * @property string $create_at
 * @property string $update_at
 *
 * @property RelasiKelasSiswa[] $relasiKelasSiswas
 * @property User $createBy
 */
class TahunAjaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tahun_ajaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_thn_ajaran', 'kode_tahun_ajaran', 'nama', 'tanggal_mulai', 'tanggal_selesai', 'status', 'create_by'], 'required'],
            [['tanggal_mulai', 'tanggal_selesai', 'create_at', 'update_at'], 'safe'],
            [['status', 'create_by'], 'integer'],
            [['uid_thn_ajaran'], 'string', 'max' => 25],
            [['kode_tahun_ajaran'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 100],
            [['kode_tahun_ajaran', 'nama'], 'unique', 'targetAttribute' => ['kode_tahun_ajaran', 'nama'], 'message' => 'The combination of Kode Tahun Ajaran and Nama has already been taken.'],
            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid_thn_ajaran' => 'Uid Thn Ajaran',
            'kode_tahun_ajaran' => 'Kode Tahun Ajaran',
            'nama' => 'Nama',
            'tanggal_mulai' => 'Tanggal Mulai',
            'tanggal_selesai' => 'Tanggal Selesai',
            'status' => 'Status',
            'create_by' => 'Create By',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelasiKelasSiswas()
    {
        return $this->hasMany(RelasiKelasSiswa::className(), ['uid_tahun_ajaran' => 'uid_thn_ajaran']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'create_by']);
    }
}
