<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 21.11.2018
 * Time: 0:47
 */

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Materialize css and Js file
 * Included form npm/materialize
 */
class MaterializeAsset extends AssetBundle
{

    public $sourcePath = '@npm/materialize-css/';
    public $baseUrl = '@web';

    public $css = [
        'dist/css/materialize.min.css',
    ];

    public $js = [
        'dist/js/materialize.min.js'
    ];
}


