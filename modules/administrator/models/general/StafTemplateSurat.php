<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "staf_template_surat".
 *
 * @property string $uid_template_surat
 * @property string $uid_untuk_sekolah
 * @property string $nama_template
 * @property string $deskripsi_template
 * @property string $path_template
 * @property integer $status
 * @property integer $create_by
 * @property string $create_at
 * @property string $update_at
 *
 * @property StafJenisSurat[] $stafJenisSurats
 * @property User $createBy
 * @property DmSekolah $uidUntukSekolah
 */
class StafTemplateSurat extends \yii\db\ActiveRecord
{
    public $document;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staf_template_surat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_template_surat', 'uid_untuk_sekolah', 'nama_template', 'deskripsi_template', 'path_template', 'status', 'create_by'], 'required'],
            [['deskripsi_template'], 'string'],
            [['document'], 'file', 'skipOnEmpty' => true, 'extensions'=>''],
            ['document', 'required', 'on' => 'create'],
            [['status', 'create_by'], 'integer'],
            ['document', 'required', 'on' => 'create'],
            [['create_at', 'update_at'], 'safe'],
            [['uid_template_surat', 'uid_untuk_sekolah'], 'string', 'max' => 25],
            [['nama_template', 'path_template'], 'string', 'max' => 100],
            [['nama_template'], 'unique'],
            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
            [['uid_untuk_sekolah'], 'exist', 'skipOnError' => true, 'targetClass' => DmSekolah::className(), 'targetAttribute' => ['uid_untuk_sekolah' => 'uid_dm_sekolah']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid_template_surat' => 'Uid Template Surat',
            'uid_untuk_sekolah' => 'Untuk Sekolah Sekolah',
            'nama_template' => 'Nama Template',
            'deskripsi_template' => 'Deskripsi Template',
            'path_template' => 'Path Template',
            'status' => 'Status',
            'create_by' => 'Create By',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStafJenisSurats()
    {
        return $this->hasMany(StafJenisSurat::className(), ['uid_template_surat' => 'uid_template_surat']);
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
    public function getUidUntukSekolah()
    {
        return $this->hasOne(DmSekolah::className(), ['uid_dm_sekolah' => 'uid_untuk_sekolah']);
    }
}
