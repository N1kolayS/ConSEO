<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 25.11.2018
 * Time: 21:20
 *
 * Field адаптированные под шаблон efnify
 */

namespace common\efnify\widgets;



class ActiveForm extends \yii\widgets\ActiveForm
{

    /**
     * @var string the CSS class that is added to a field container when the associated attribute is being validated.
     */
    public $validatingCssClass = 'validate';

    /**
     * @var string the default field class name when calling [[field()]] to create a new field.
     * @see fieldConfig
     */
     public $fieldClass = 'common\efnify\widgets\ActiveField';



}