<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 26.11.2018
 * Time: 13:14
 */

namespace console\controllers;

use common\models\Domain;
use common\models\Visit;
use Yii;
use yii\console\Controller;

class TestController extends Controller
{

    public function actionDomain($address)
    {
        echo $address.PHP_EOL;
        try {
            $domain = new Domain($address);

            $check = $domain->checkDomain();
            if ($check)
            {
                echo  'Result = '.$check.PHP_EOL;

                $image = $domain->saveImgFile();

                echo 'image'. $image;
            }
        } catch (\Exception $exception)
        {
            echo 'Exception';
        }

    }


}