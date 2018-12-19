<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 04.12.2018
 * Time: 22:19
 */

/**
 * Шаблон для JS кода, чистый контент
 */

/* @var $content string */

if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}
?>
<?= $content ?>
