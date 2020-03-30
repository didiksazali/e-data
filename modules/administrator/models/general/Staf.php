<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "staf".
 *
 * @property string $uid_staf
 * @property integer $nip
 * @property string $nama
 * @property integer $jenis_kelamin
 * @property string $alamat
 * @property string $status_kepegawaian
 * @property integer $status_keluarga
 * @property string $jabatan
 * @property string $gdrive_pasfoto_staf
 * @property integer $hak_akses
 * @property integer $create_by
 * @property string $create_at
 * @property string $update_at
 *
 * @property User $createBy
 */
class Staf extends \yii\db\ActiveRecord
{
    public $email;
    public $password;
    public $foto;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staf';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_staf', 'nip', 'nama', 'jenis_kelamin', 'alamat', 'status_kepegawaian', 'status_keluarga', 'jabatan', 'hak_akses'], 'required', 'message'=>'{attribute} wajib diisi...'],
            ['password', 'required', 'on' => 'create'],
            [['foto'], 'file', 'skipOnEmpty' => true, 'extensions'=>'jpeg, jpg, png, gif'],
            //['foto', 'required', 'on' => 'create'],
            [['nip', 'jenis_kelamin', 'status_keluarga', 'hak_akses', 'create_by'], 'integer', 'message'=>'{attribute} wajib angka...'],
            [['status_kepegawaian'], 'string'],
            [['create_at', 'update_at'], 'safe'],
            [['uid_staf'], 'string', 'max' => 25],
            [['nama'], 'string', 'max' => 50],
            [['alamat', 'gdrive_pasfoto_staf'], 'string', 'max' => 100],
            [['jabatan'], 'string', 'max' => 20],
            [['nip'], 'unique', 'message'=>'{attribute} sudah terdaftar...'],
            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid_staf' => 'Uid Staf',
            'nip' => 'Nip',
            'nama' => 'Nama',
            'jenis_kelamin' => 'Jenis Kelamin',
            'alamat' => 'Alamat',
            'foto'=> 'Pas Foto',
            'status_kepegawaian' => 'Status Kepegawaian',
            'status_keluarga' => 'Status Keluarga',
            'jabatan' => 'Jabatan',
            'gdrive_pasfoto_staf' => 'Gdrive Pasfoto Staf',
            'hak_akses' => 'Hak Akses',
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

    public function getJabatanStaf()
    {
        return $this->hasOne(DmJabatan::className(), ['kode_jabatan' => 'jabatan']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'hak_akses']);
    }
}
