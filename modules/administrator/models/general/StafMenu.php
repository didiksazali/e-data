<?php

namespace app\modules\administrator\models\general;

use Yii;

/**
 * This is the model class for table "staf_menu".
 *
 * @property string $uid_menu
 * @property integer $squence_number
 * @property string $title
 * @property string $display_name
 * @property string $link
 * @property string $target
 * @property string $icon
 * @property string $parent_uid
 * @property string $image
 * @property string $for_app
 * @property integer $create_by
 * @property string $create_at
 * @property string $update_at
 *
 * @property User $createBy
 */
class StafMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staf_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_menu', 'squence_number', 'display_name', 'for_app', 'create_by'], 'required'],
            [['squence_number', 'create_by'], 'integer'],
            [['title'], 'string'],
            [['create_at', 'update_at'], 'safe'],
            [['uid_menu', 'parent_uid'], 'string', 'max' => 25],
            [['display_name', 'link', 'image'], 'string', 'max' => 100],
            [['target', 'icon'], 'string', 'max' => 45],
            [['for_app'], 'string', 'max' => 10],
            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid_menu' => 'Uid Menu',
            'squence_number' => 'Squence Number',
            'title' => 'Title',
            'display_name' => 'Display Name',
            'link' => 'Link',
            'target' => 'Target',
            'icon' => 'Icon',
            'parent_uid' => 'Parent Uid',
            'image' => 'Image',
            'for_app' => 'For App',
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
