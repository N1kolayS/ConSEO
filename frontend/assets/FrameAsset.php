<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 04.12.2018
 * Time: 16:31
 */

namespace frontend\assets;
use yii\web\AssetBundle;

/**
 * Asset for show widget in iFrame
 * Class FrameAsset
 * @package frontend\assets
 */
class FrameAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
    ];
    public $depends = [

    ];
}