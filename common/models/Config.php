<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%config}}".
 * Config for Autostart
 * @property int $id
 * @property int $type
 * @property string $description
 * @property string $role
 * @property string $value
 */
class Config extends \yii\db\ActiveRecord
{


    const TYPE_PRESET_CHANNEL = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['type'], 'required'],

            [['description', 'role', 'value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array
     */
    public static function listType()
    {
        return [
            self::TYPE_PRESET_CHANNEL => 'Предустановки',

        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'description' => 'Description',
            'role' => 'Role',
            'value' => 'Value',
        ];
    }
}
