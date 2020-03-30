<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "alat_transport".
 *
 * @property integer $id_alat_transport
 * @property string $nm_alat_transport
 *
 * @property DataSiswa[] $dataSiswas
 * @property DataSiswa[] $dataSiswas0
 */
class AlatTransport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alat_transport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_alat_transport', 'nm_alat_transport'], 'required'],
            [['id_alat_transport'], 'integer'],
            [['nm_alat_transport'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_alat_transport' => 'Id Alat Transport',
            'nm_alat_transport' => 'Nm Alat Transport',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataSiswas()
    {
        return $this->hasMany(DataSiswa::className(), ['id_transportasi_kesekolah' => 'id_alat_transport']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataSiswas0()
    {
        return $this->hasMany(DataSiswa::className(), ['id_alat_transport_orangtua' => 'id_alat_transport']);
    }
}
