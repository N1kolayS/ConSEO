<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "channel_position".
 *
 * @property int $channel_id
 * @property int $position_id
 * @property string $val
 *
 * @property Channel $channel
 * @property Position $position
 */
class ChannelPosition extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'channel_position';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['channel_id', 'position_id'], 'required'],
            [['channel_id', 'position_id'], 'integer'],
            [['val'], 'string', 'max' => 255],
            [['channel_id', 'position_id'], 'unique', 'targetAttribute' => ['channel_id', 'position_id']],
            [['channel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Channel::className(), 'targetAttribute' => ['channel_id' => 'id']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Position::className(), 'targetAttribute' => ['position_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'channel_id' => 'Channel ID',
            'position_id' => 'Position ID',
            'val' => 'Val',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChannel()
    {
        return $this->hasOne(Channel::className(), ['id' => 'channel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Position::className(), ['id' => 'position_id']);
    }
}
