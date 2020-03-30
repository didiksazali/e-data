<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "pendidikan".
 *
 * @property integer $id_pendidikan
 * @property string $nama_pendidikan
 * @property string $u_jenj_lemb
 * @property string $u_jenj_org
 *
 * @property Anggota[] $anggotas
 */
class Pendidikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pendidikan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pendidikan', 'nama_pendidikan', 'u_jenj_lemb', 'u_jenj_org'], 'required'],
            [['id_pendidikan'], 'integer'],
            [['nama_pendidikan'], 'string', 'max' => 25],
            [['u_jenj_lemb', 'u_jenj_org'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pendidikan' => 'Id Pendidikan',
            'nama_pendidikan' => 'Nama Pendidikan',
            'u_jenj_lemb' => 'U Jenj Lemb',
            'u_jenj_org' => 'U Jenj Org',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnggotas()
    {
        return $this->hasMany(Anggota::className(), ['id_pendidikan' => 'id_pendidikan']);
    }
}
