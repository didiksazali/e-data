<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "semester".
 *
 * @property string $uid_semester
 * @property integer $no_urut
 * @property string $nm_smt
 * @property string $id_thn_ajaran
 * @property string $smt
 * @property string $a_periode_aktif
 * @property string $tgl_mulai
 * @property string $tgl_selesai
 * @property integer $create_by
 * @property string $create_at
 * @property string $update_at
 */
class Semester extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semester';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_semester', 'no_urut', 'nm_smt', 'id_thn_ajaran', 'smt', 'a_periode_aktif', 'tgl_mulai', 'tgl_selesai'], 'required'],
            [['no_urut', 'create_by'], 'integer'],
            [['tgl_mulai', 'tgl_selesai', 'create_at', 'update_at'], 'safe'],
            [['uid_semester'], 'string', 'max' => 25],
            [['nm_smt'], 'string', 'max' => 20],
            [['id_thn_ajaran'], 'string', 'max' => 10],
            [['smt', 'a_periode_aktif'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid_semester' => 'Uid Semester',
            'no_urut' => 'No Urut',
            'nm_smt' => 'Nm Smt',
            'id_thn_ajaran' => 'Id Thn Ajaran',
            'smt' => 'Smt',
            'a_periode_aktif' => 'A Periode Aktif',
            'tgl_mulai' => 'Tgl Mulai',
            'tgl_selesai' => 'Tgl Selesai',
            'create_by' => 'Create By',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }
}
