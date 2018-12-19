<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 21.11.2018
 * Time: 1:00
 */

namespace common\assets;

use yii\web\AssetBundle;

/**
 * NPM css and Js file
 * Included form npm/materialize
 */
class PrismjsAsset extends AssetBundle
{

    public $sourcePath = '@npm/prismjs/';
    public $baseUrl = '@web';

    public $css = [
        'themes/prism.css',
    ];

    public $js = [
        'prism.js'
    ];
}


