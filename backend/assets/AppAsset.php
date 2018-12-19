<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
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

    ];
}
