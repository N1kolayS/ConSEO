<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 06.12.2018
 * Time: 22:52
 */

namespace common\assets;
use yii\web\AssetBundle;

/**
 * Js tour
 * https://github.com/xbsoftware/enjoyhint
 * Added from npm
 * Class EnjoyhintAsset
 * @package common\assets
 */
class EnjoyhintAsset extends AssetBundle
{

    public $sourcePath = '@npm/enjoyhint.js/';
    public $baseUrl = '@web';

    public $css = [
        'enjoyhint.css',
    ];

    public $js = [
        'enjoyhint.js'
    ];

    public $depends = [

        'yii\web\JqueryAsset',

    ];
}