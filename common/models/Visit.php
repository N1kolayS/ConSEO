<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%visit}}".
 *
 * @property int $id
 * @property int $project_id
 * @property int $channel_id
 * @property int $created_at
 * @property int $mobile
 * @property string $url
 * @property string $ref
 * @property string $browser
 * @property string $ip
 * @property string $cookie
 * @property string $info
 * @property string $loaded
 * @property string $viewed
 * @property string $used
 *
 * @property Channel $channel
 * @property Project $project
 */
class Visit extends \yii\db\ActiveRecord
{

    /**
     * Генерация уникальной строки для куки проектИд_случайнаяСтрока
     * @param integer $project_id
     * @return string
     * @throws \yii\base\Exception
     */
    private static function generateCookie($project_id)
    {
        return $project_id.'_'.Yii::$app->security->generateRandomString();
    }

    /**
     * @param $cookie
     * @return bool|static
     */
    public static function findByCookie($cookie)
    {
        if (($model=self::findOne(['cookie' => $cookie])) !== null)
            return $model;
        else
            return false;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%visit}}';
    }

    /**
     * @inheritdoc
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
            [['project_id', 'channel_id'], 'required'],
            [['project_id', 'channel_id', 'created_at', 'mobile', 'loaded', 'viewed', 'used'], 'integer'],
            [['url', 'ref', 'browser', 'ip', 'cookie', 'info'], 'string', 'max' => 255],
            [['channel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Channel::className(), 'targetAttribute' => ['channel_id' => 'id']],
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
            'channel_id' => 'Channel ID',
            'created_at' => 'Created At',
            'mobile' => 'Mobile',
            'url' => 'Url',
            'ref' => 'Ref',
            'browser' => 'Browser',
            'ip' => 'Ip',
            'cookie' => 'Cookie',
            'info' => 'Info',
            'loaded' => 'Loaded',
            'viewed' => 'Viewed',
            'used' => 'Used',
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
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * Передача данных из XHTTP запроса  при первом заходе. В случае отсутствия куки (либо неправильно значения) генерируется новый визит с полученной информацией.
     * Если по полученным куки можно найти визит, то просто обновляем счетчик посещений
     *
     * @param $project_id
     * @param $channel_id
     * @param $cookie
     * @param $url
     * @param $ref
     * @param $ip
     * @param $browser
     * @param $mobile
     * @return bool|Visit
     * @throws
     */
    public static function saveVisit($project_id, $channel_id, $cookie,  $url, $ref, $ip, $browser, $mobile=0)
    {
        $visit = self::findByCookie($cookie);
        if ($visit)
        {
            $visit->updateCounters(['loaded' =>1]);
        }
        else
        {
            $visit = new  Visit();
            $visit->project_id = $project_id;
            $visit->channel_id = $channel_id;
            $visit->ref = $ref;
            $visit->url = $url;
            $visit->ip = $ip;
            $visit->browser = $browser;
            $visit->cookie = self::generateCookie($project_id);
            $visit->loaded = 1;
            if ($mobile=='1') { $visit->mobile = 1; }

            $visit->save();

        }
        return $visit;
    }
}
