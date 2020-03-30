<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "jenjang_pendidikan".
 *
 * @property integer $id_jenj_didik
 * @property string $nm_jenj_didik
 * @property string $u_jenj_lemb
 * @property string $u_jenj_org
 *
 * @property DataSiswa[] $dataSiswas
 * @property DataSiswa[] $dataSiswas0
 * @property DataSiswa[] $dataSiswas1
 */
class JenjangPendidikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jenjang_pendidikan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_jenj_didik', 'nm_jenj_didik', 'u_jenj_lemb', 'u_jenj_org'], 'required'],
            [['id_jenj_didik'], 'integer'],
            [['nm_jenj_didik'], 'string', 'max' => 25],
            [['u_jenj_lemb', 'u_jenj_org'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_jenj_didik' => 'Id Jenj Didik',
            'nm_jenj_didik' => 'Nm Jenj Didik',
            'u_jenj_lemb' => 'U Jenj Lemb',
            'u_jenj_org' => 'U Jenj Org',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataSiswas()
    {
        return $this->hasMany(DataSiswa::className(), ['id_pendidikan_ayah' => 'id_jenj_didik']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataSiswas0()
    {
        return $this->hasMany(DataSiswa::className(), ['id_pekerjaan_ayah' => 'id_jenj_didik']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataSiswas1()
    {
        return $this->hasMany(DataSiswa::className(), ['id_pendidikan_ibu' => 'id_jenj_didik']);
    }
}
