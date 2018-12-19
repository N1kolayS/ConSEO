<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%template}}".
 *
 * @property int $id
 * @property string $name
 * @property string $preview
 * @property string $code
 * @property string $file
 * @property int $enable
 *
 * @property WidgetFrame[] $widgetFrames
 */
class Template extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%template}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'string'],
            [['enable'], 'integer'],
            [['name', 'preview', 'file'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'preview' => 'Preview',
            'code' => 'Code',
            'file' => 'File',
            'enable' => 'Enable',
        ];
    }

    /**
     * @return array
     */
    public static function listAll()
    {
        return ArrayHelper::map(self::find()->all(),'id','name');
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWidgetFrames()
    {
        return $this->hasMany(WidgetFrame::className(), ['template_id' => 'id']);
    }
}
