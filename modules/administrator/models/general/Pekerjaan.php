<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "pekerjaan".
 *
 * @property integer $id_pekerjaan
 * @property string $nama_pekerjaan
 *
 * @property Anggota[] $anggotas
 */
class Pekerjaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pekerjaan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pekerjaan', 'nama_pekerjaan'], 'required'],
            [['id_pekerjaan'], 'integer'],
            [['nama_pekerjaan'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pekerjaan' => 'Id Pekerjaan',
            'nama_pekerjaan' => 'Nama Pekerjaan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnggotas()
    {
        return $this->hasMany(Anggota::className(), ['id_pekerjaan' => 'id_pekerjaan']);
    }
}
