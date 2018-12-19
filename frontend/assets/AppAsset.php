<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'theme/css/app.css',
        'theme/css/helper.css',
        'theme/css/responsive.css',
        'theme/css/theme/default.css',
    ];
    public $js = [
        'theme/js/app.js',
        'theme/js/search.js',

    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'common\assets\MaterializeAsset',
      //  'common\assets\PrismjsAsset', // Подсветка синтаксиса
        'common\assets\YiiAsset',
    ];
}
