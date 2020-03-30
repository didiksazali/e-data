<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "logs".
 *
 * @property integer $id_logs
 * @property string $type
 * @property string $device_info
 * @property string $old_data
 * @property string $new_data
 * @property integer $id_user
 * @property string $time_at
 *
 * @property User $idUser
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'device_info'], 'required'],
            [['type', 'device_info', 'old_data', 'new_data'], 'string'],
            [['id_user'], 'integer'],
            [['time_at'], 'safe'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_logs' => 'Id Logs',
            'type' => 'Type',
            'device_info' => 'Device Info',
            'old_data' => 'Old Data',
            'new_data' => 'New Data',
            'id_user' => 'Id User',
            'time_at' => 'Time At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
