<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "dpw".
 *
 * @property integer $id_dpw
 * @property string $nama_dpw
 *
 * @property Anggota[] $anggotas
 */
class Dpw extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dpw';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_dpw'], 'required'],
            [['nama_dpw'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_dpw' => 'Id Dpw',
            'nama_dpw' => 'Nama Dpw',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnggotas()
    {
        return $this->hasMany(Anggota::className(), ['id_dpw' => 'id_dpw']);
    }
}
