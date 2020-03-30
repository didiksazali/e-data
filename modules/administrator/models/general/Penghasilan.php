<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "penghasilan".
 *
 * @property integer $id_penghasilan
 * @property string $nama_penghasilan
 * @property integer $batas_bawah
 * @property integer $batas_atas
 *
 * @property Anggota[] $anggotas
 */
class Penghasilan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'penghasilan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_penghasilan', 'nama_penghasilan', 'batas_bawah', 'batas_atas'], 'required'],
            [['id_penghasilan', 'batas_bawah', 'batas_atas'], 'integer'],
            [['nama_penghasilan'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_penghasilan' => 'Id Penghasilan',
            'nama_penghasilan' => 'Nama Penghasilan',
            'batas_bawah' => 'Batas Bawah',
            'batas_atas' => 'Batas Atas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnggotas()
    {
        return $this->hasMany(Anggota::className(), ['id_penghasilan' => 'id_penghasilan']);
    }
}
