<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "dpd".
 *
 * @property integer $id_dpd
 * @property string $nama_dpd
 *
 * @property Anggota[] $anggotas
 */
class Dpd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dpd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_dpd'], 'required'],
            [['nama_dpd'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_dpd' => 'Id Dpd',
            'nama_dpd' => 'Nama Dpd',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnggotas()
    {
        return $this->hasMany(Anggota::className(), ['id_dpd' => 'id_dpd']);
    }
}
