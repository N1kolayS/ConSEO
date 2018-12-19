<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 04.12.2018
 * Time: 15:37
 */

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Class YiiAsset
 * @package common\assets
 */
class YiiAsset extends AssetBundle
{
    public $sourcePath = '@yii/assets';
    public $js = [
        'yii.js',
    ];

}
