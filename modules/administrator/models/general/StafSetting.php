<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "staf_setting".
 *
 * @property string $uid_setting
 * @property string $name
 * @property string $value
 * @property string $value_
 * @property integer $create_by
 * @property string $create_at
 * @property string $update_at
 *
 * @property User $createBy
 */
class StafSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staf_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_setting', 'value_', 'create_by'], 'required'],
            [['value_'], 'string'],
            [['create_by'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['uid_setting'], 'string', 'max' => 25],
            [['name'], 'string', 'max' => 100],
            [['value'], 'string', 'max' => 225],
            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid_setting' => 'Uid Setting',
            'name' => 'Name',
            'value' => 'Value',
            'value_' => 'Value',
            'create_by' => 'Create By',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'create_by']);
    }
}
