<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%channel}}".
 *
 * @property int $id
 * @property int $project_id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $title
 * @property string $phone
 * @property int $default
 * @property int $enable
 * @property string $referral
 * @property string $utm_source
 * @property string $utm_campaign
 *
 * @property Project $project
 */
class Channel extends \yii\db\ActiveRecord
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%channel}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id'], 'required'],
            [['project_id', 'default', 'enable'], 'integer'],
            [['code', 'name', 'description', 'title', 'phone', 'referral', 'utm_source', 'utm_campaign'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'code' => 'Code',
            'name' => 'Name',
            'description' => 'Description',
            'title' => 'Title',
            'phone' => 'Phone',
            'default' => 'Default',
            'enable' => 'Enable',
        ];
    }

    /**
     * @param $id
     * @return Channel | null
     */
    public static function findOneByUser($id)
    {
        $channel = self::findOne($id);
        if (($channel)&&($channel->project->user_id == Yii::$app->user->id))
            return $channel;
        else
            return null;
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        if ($this->default)
            return true;
        else
            return false;
    }

    /**
     * @return bool
     */
    public function isEnable()
    {
        if ($this->enable)
            return true;
        else
            return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
