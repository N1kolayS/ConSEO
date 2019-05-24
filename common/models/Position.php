<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "position".
 *
 * @property int $id
 * @property int $project_id
 * @property string $name
 * @property string $htmlId
 * @property string $htmlClass
 *
 * @property ChannelPosition[] $channelPositions
 * @property Channel[] $channels
 * @property Project $project
 * @property array $matrix
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'position';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'name', 'htmlId'], 'required'],
            [['project_id'], 'integer'],
            [['name', 'htmlId', 'htmlClass'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'htmlId' => 'Html ID',
            'htmlClass' => 'Html Class',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChannelPositions()
    {
        return $this->hasMany(ChannelPosition::className(), ['position_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChannels()
    {
        return $this->hasMany(Channel::className(), ['id' => 'channel_id'])->viaTable('channel_position', ['position_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return array
     */
    public function getMatrix()
    {
        $data = [];
        foreach ($this->project->channels as $channel)
        {
            foreach ($this->project->positions as $position)
            {
                $ChannelPosition = ChannelPosition::find()->where(['channel_id' => $channel->id, 'position_id' => $position->id])->one();
                if ($ChannelPosition)
                    $data[$channel->id][$position->id] = $ChannelPosition;
                else
                    $data[$channel->id][$position->id] =  null;
            }
        }
        return $data;
    }

    /**
     * @param $channel_id
     * @param $position_id
     */
    public static function showValue($channel_id, $position_id)
    {
        ChannelPosition::find()->where(['channel_id' => $channel_id, 'position_id' => $position_id])->one();
    }
}
