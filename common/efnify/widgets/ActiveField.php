<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 25.11.2018
 * Time: 21:26
 */

/**
 * Class ActiveFiled
 */

namespace common\efnify\widgets;

/**
 * Class ActiveFiled
 * @package common\efnify\widgets
 */
class ActiveField extends \yii\widgets\ActiveField
{

    /**
     * @var string the default field class name when calling [[field()]] to create a new field.
     * @see fieldConfig
     */


    public $options = ['class' => 'input-field col s6 '];

    public $template = "{input}\n{label}\n{hint}";

    public $inputOptions = ['class' => ''];

    public $labelOptions = ['class' => ''];
}