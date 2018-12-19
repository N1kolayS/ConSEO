<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 04.12.2018
 * Time: 16:32
 */

/* @var $this \yii\web\View */
/* @var $content string */

if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}

//\frontend\assets\FrameAsset::register($this);

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Frame</title>
        <?php $this->head() ?>

    </head>
    <body>
    <?php $this->beginBody() ?>

    <?= $content ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>