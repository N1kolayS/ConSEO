<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%map_referral}}".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $type_id
 * @property int $sort
 */
class MapReferral extends \yii\db\ActiveRecord
{

    const TYPE_SEARCH = 1;
    const TYPE_SOCIAL = 2;
    const TYPE_OTHER = 3;
    const TYPE_MAIL = 4;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%map_referral}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'trim'],
            [['type_id', 'sort'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
            [['name', 'url', 'type_id'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'type_id' => 'Type ID',
            'sort' => 'Сортировка',
        ];
    }

    /**
     * @return array
     */
    public static function listType()
    {
        return [
            self::TYPE_SEARCH => 'Поисковики',
            self::TYPE_SOCIAL => 'Соцсети',
            self::TYPE_OTHER => 'Прочее',
            self::TYPE_MAIL => 'Почтовики',
        ];
    }

    /**
     * @param $type
     * @return static[]
     */
    public static function listByType($type)
    {
        return self::findAll(['type_id' => $type]);
    }

    /**
     * @return array
     * For select optGorup
     *
     * array(....) {
     * ["Поисковики"]=> array(..) {
     *      ["yandex.ru"]=> "Яндекс Поиск"
     *      ["an.yandex.ru"]=>  "Яндекс Директ"
     * } ["Соцсети"]=> array(...)
     * {
     *      ["away.vk.com"]=>  "Вконтакте"
     * }
     * }
     */
    public static function selectByGroup() {

        $options = [];
        foreach (self::listType() as $key => $type)
        {
            $children = self::find()->where(['type_id'=> $key])->asArray()->all();
            $opt = ArrayHelper::map($children, 'url', 'name');
            if ($children) {
                $options[$type] = $opt;
            }

        }
        return $options;

    }

    /**
     * @return array
     */
    public static function listAllMap()
    {
        return ArrayHelper::map(self::find()->all(), 'url', 'name');
    }
}
