<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "dpc".
 *
 * @property integer $id_dpc
 * @property integer $nama_dpc
 *
 * @property Anggota[] $anggotas
 */
class Dpc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dpc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_dpc'], 'required'],
            [['nama_dpc'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_dpc' => 'Id Dpc',
            'nama_dpc' => 'Nama Dpc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnggotas()
    {
        return $this->hasMany(Anggota::className(), ['id_dpc' => 'id_dpc']);
    }
}
