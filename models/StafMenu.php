<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staf_menu".
 *
 * @property integer $id_menu
 * @property integer $squence_number
 * @property string $title
 * @property integer $display_name
 * @property string $link
 * @property string $target
 * @property string $icon
 * @property integer $parent_id
 * @property string $image
 * @property string $for_app
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
            [['squence_number', 'display_name', 'for_app'], 'required'],
            [['squence_number', 'display_name', 'parent_id'], 'integer'],
            [['title', 'link'], 'string'],
            [['target', 'icon'], 'string', 'max' => 45],
            [['image'], 'string', 'max' => 100],
            [['for_app'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_menu' => 'Id Menu',
            'squence_number' => 'Squence Number',
            'title' => 'Title',
            'display_name' => 'Display Name',
            'link' => 'Link',
            'target' => 'Target',
            'icon' => 'Icon',
            'parent_id' => 'Parent ID',
            'image' => 'Image',
            'for_app' => 'For App',
        ];
    }
}
