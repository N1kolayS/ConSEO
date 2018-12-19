<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 30.11.2018
 * Time: 12:40
 */


namespace common\efnify\grid;


use Yii;
use yii\helpers\Html;



class ActionColumn extends \yii\grid\ActionColumn {

    /**
     * Initializes the default button rendering callback for single button.
     * @param string $name Button name as it's written in template
     * @param string $iconName The part of Bootstrap glyphicon class that makes it unique
     * @param array $additionalOptions Array of additional options
     * @since 2.0.11
     */
    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'View');
                        $ico = 'pageview';
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Update');
                        $ico = 'edit';
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Delete');
                        $ico = 'delete';
                        break;
                    default:
                        $ico = '';
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);
                $icon = Html::tag('i', $ico, ['class' => "material-icons"]);
                return Html::a($icon, $url, $options);
            };
        }
    }
}