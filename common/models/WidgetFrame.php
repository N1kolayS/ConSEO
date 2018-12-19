<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%widgetFrame}}".
 *
 * @property int $id
 * @property int $project_id
 * @property int $template_id
 * @property string $title
 * @property string $title_flip
 * @property string $text
 * @property string $phone
 * @property int $position
 * @property int $enable
 * @property string $name
 * @property string $selected
 * @property string $code
 *
 * @property bool $mobile
 *
 * @property Project $project
 * @property Template $template
 */
class WidgetFrame extends \yii\db\ActiveRecord
{

    const POSITION_LEFT_TOP     = 1;
    const POSITION_LEFT_MIDDLE  = 2;
    const POSITION_LEFT_BOTTOM  = 3;
    const POSITION_RIGHT_TOP    = 4;
    const POSITION_RIGHT_MIDDLE = 5;
    const POSITION_RIGHT_BOTTOM = 6;

    /**
     * Список позиций.
     * Используется в настройках оформления _decor.php
     * @return array
     */
    public static function listPosition()
    {
        return [
            self::POSITION_LEFT_TOP     => 'Слева наверху',
            self::POSITION_LEFT_MIDDLE  => 'Слева посередине',
            self::POSITION_LEFT_BOTTOM  => 'Слева внизу',
            self::POSITION_RIGHT_TOP    => 'Справа наверху',
            self::POSITION_RIGHT_MIDDLE => 'Справа посередине',
            self::POSITION_RIGHT_BOTTOM => 'Справа внизу',
        ];
    }

    /**
     * Мобильная версия виджета или нет
     * @var
     */
    private $_mobile;

    /**
     * @var
     */
    private $_code;

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->_mobile;
    }

    /**
     * @param $value
     */
    public function setMobile($value)
    {
        $this->_mobile = ($value!=null) ? true : false;
    }

    /**
     * Если код не передан в виджет, ставим код с канала по умолчанию
     * @return mixed
     */
    public function getCode()
    {
        $default = $this->project->defaultChannel;
        $code = ($default) ? $default->code : 000;
        return ($this->_code) ? $this->_code : $code;
    }

    /**
     * @param $value
     */
    public function setCode($value)
    {

        $this->_code = $value;
    }

    /**
     * Определяем позицию виджет. Слева или справа
     * @return bool
     */
    public function isLeft()
    {
        if (($this->position==self::POSITION_LEFT_TOP)||($this->position==self::POSITION_LEFT_MIDDLE)||($this->position==self::POSITION_LEFT_BOTTOM))
            return true;
        else
            return false;
    }

    /**
     *
     * Desktop frame
     * @return string
     */
    public function positionFrame()
    {
        $string = '';
        switch ($this->position) {
            case self::POSITION_LEFT_TOP:
                $string ="document.getElementById(id).style.left = '0';\n\tdocument.getElementById(id).style.top = '30px';\n";
                break;
            case self::POSITION_LEFT_MIDDLE:
                $string ="document.getElementById(id).style.left = '0';\n\tdocument.getElementById(id).style.top = '50%';\n";
                break;
            case self::POSITION_LEFT_BOTTOM:
                $string ="document.getElementById(id).style.left = '0';\n\tdocument.getElementById(id).style.bottom = '10px';\n";
                break;
            case self::POSITION_RIGHT_TOP:
                $string ="document.getElementById(id).style.right = '0';\n\tdocument.getElementById(id).style.top = '30px';\n";
                break;
            case self::POSITION_RIGHT_MIDDLE:
                $string ="document.getElementById(id).style.right = '0';\n\tdocument.getElementById(id).style.top = '50%';\n";
                break;
            case self::POSITION_RIGHT_BOTTOM:
                $string ="document.getElementById(id).style.right = '0';\n\tdocument.getElementById(id).style.bottom = '10px';\n";
                break;
        }
        return $string;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%widgetFrame}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['template_id', 'name'], 'required'],
            [['project_id', 'template_id', 'position', 'enable', 'selected'], 'integer'],
            [['title', 'title_flip', 'text', 'phone'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['template_id'], 'exist', 'skipOnError' => true, 'targetClass' => Template::className(), 'targetAttribute' => ['template_id' => 'id']],
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
            'template_id' => 'Шаблон',
            'title' => 'Заголовок с кодом',
            'title_flip' => 'Заголовок при загрузке',
            'text' => 'Text',
            'phone' => 'Телефон',
            'position' => 'Позиция',
            'enable' => 'Enable',
            'selected' => 'Назначен'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(Template::className(), ['id' => 'template_id']);
    }

    /**
     * Set default Data
     */
    public function assignedData()
    {
        $template = Template::findOne(['enable' => 1]);
        $this->name = 'По умолчанию';
        $this->template_id = $template->id;
        $this->title = 'Скидка по коду';
        $this->title_flip = 'Вам купон';
        $this->position = self::POSITION_LEFT_BOTTOM;
        $this->enable = 1;
        $this->selected = 1;

    }
}
