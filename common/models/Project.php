<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%project}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $created_at
 * @property string $name
 * @property string $host
 * @property int $enable
 * @property int $debug
 * @property string $screenShot  null - not available; frame - iframe available; url - image name
 * @property integer $wMultiStatus
 *
 * @property int $default_widget_id
 * @property User $user
 * @property WidgetFrame[] $widgetFrames
 * @property Channel[] $channels
 * @property Channel[] $channelsEnable
 * @property Channel $defaultChannel
 * @property Position[] $positions
 *
 */
class Project extends \yii\db\ActiveRecord
{

    /**
     * Статус Виджета. Включен или выключен
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%project}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'host'], 'required'],
            [['user_id', 'created_at', 'enable', 'debug'], 'integer'],
            [['name', 'host', 'screenShot'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'name' => 'Проект',
            'host' => 'URL Вашего сайт, например http://ya.ru',
            'enable' => 'Enable',
            'debug' => 'Debug',
        ];
    }

    /**
     * Включен хотя бы один из виджетов. Проект активный
     * @return bool
     */
    public function isEnabled()
    {
        if ($this->enable==self::STATUS_ENABLED)
            return true;
        else
            return false;
    }

    /**
     * @return bool
     */
    public function isWidgetMultiEnable()
    {
        if ($this->wMultiStatus==self::STATUS_ENABLED)
            return true;
        else
            return false;
    }

    /**
     * Enable widget
     * @return bool
     */
    public function wMultiTurnOn()
    {
        $this->wMultiStatus = self::STATUS_ENABLED;
        return $this->save();
    }

    /**
     * Disable widget
     * @return bool
     */
    public function wMultiTurnOff()
    {
        $this->wMultiStatus = self::STATUS_DISABLED;
        return $this->save();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWidgetFrames()
    {
        return $this->hasMany(WidgetFrame::className(), ['project_id' => 'id']);
    }

    /**
     * Default channel always top
     * @return \yii\db\ActiveQuery
     */
    public function getChannels()
    {
        return $this->hasMany(Channel::className(), ['project_id' => 'id'])->orderBy(['default' => SORT_DESC]);
    }

    /**
     * Default channel always top
     * @return \yii\db\ActiveQuery
     */
    public function getChannelsEnable()
    {
        return $this->hasMany(Channel::className(), ['project_id' => 'id'])->andOnCondition(['enable' => Channel::STATUS_ENABLE])->orderBy(['default' => SORT_DESC]);
    }

    /**
     * Positions[]
     * @return \yii\db\ActiveQuery| null
     */
    public function getPositions()
    {
        return $this->hasMany(Position::className(), ['project_id' => 'id']);
    }
    /**
     * @param $id
     * @return Project
     */
    public static function findOneByUser($id)
    {
        return self::findOne(['id' => $id, 'user_id'=>Yii::$app->user->id]);
    }


    /**
     * @return WidgetFrame|null
     */
    public  function findDefaultWidget()
    {
        if (count($this->widgetFrames)>0)
        {
            return $this->widgetFrames[0];
        }
        else
        {
            return null;
        }
    }

    /**
     * @return int | null
     */
    public  function getDefault_widget_id()
    {
        if (count($this->widgetFrames)>0)
        {
            return $this->widgetFrames[0]->id;
        }
        else
        {
            return null;
        }
    }

    /**
     * Check is available iFrame
     * @return bool
     */
    public function isFrame()
    {
        if ($this->screenShot == 'frame') {
            return true;
        }
        return false;
    }

    /**
     * Get screenShot image
     * @return string
     */
    public function getScreenShotImage() {
        if (($this->screenShot!=null)&&($this->screenShot != 'frame')) {
            return '/screenshot/'.$this->screenShot;
        }
        else
            return '/img/demo.png';
    }

    /**
     * Канал по умолчанию
     * @return Channel|false|array
     */
    public function getDefaultChannel()
    {
        $channel = Channel::find()->where(['project_id'=> $this->id, ])->andWhere(['not', ['default' => null]])->one();
        if ($channel)
            return $channel;
        else
            return false;
    }

    /**
     * Привязка пользователя
     * @param bool $insert
     * @return bool
     * @throws
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            if ($this->isNewRecord) {
                $this->user_id = Yii::$app->user->id;

            }
            return true;
        }
        return false;
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) // Check new record. Analog isNewRecord.
        {
            // Assigned channel for project
            foreach (Yii::$app->params['map.start'] as $chan)
            {
                $channel = new Channel();
                $channel->setAttributes($chan);
                $channel->project_id = $this->id;
                $channel->save();
            }
            // Assigned widget
            $widget = new WidgetFrame();
            $widget->project_id = $this->id;
            $widget->assignedData();
            $widget->save();
        }
    }
}
