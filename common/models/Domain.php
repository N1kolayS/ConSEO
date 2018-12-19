<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 26.11.2018
 * Time: 12:22
 */

namespace common\models;

use Yii;
use yii\httpclient\Client;

/**
 * Class Domain
 * @package common\models
 */
class Domain
{

    private $_address;

    /**
     * Domain constructor.
     * @param $address
     * @throws \Exception
     */
    public function __construct($address)
    {
        $rawHost = parse_url($address);

        if (array_key_exists('host', $rawHost)||array_key_exists('path', $rawHost))
        {
            $scheme = array_key_exists('scheme', $rawHost) ? $rawHost['scheme'] : 'http';
            $path = array_key_exists('host', $rawHost) ? $rawHost['host'] : $rawHost['path'];
            $this->_address = $scheme.'://'.idn_to_utf8($path);

        }
        else
        {
            throw new \Exception(Yii::t('yii', 'Адрес не верный'));
        }

    }

    /**
     * Проверка существования доменного имени
     *
     * @return bool|string
     */
    public  function checkDomain()
    {
        $ch = curl_init($this->_address);
        curl_setopt_array($ch, [
            CURLOPT_TIMEOUT => 5,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_NOBODY => true,
        ]);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $return = ($httpCode>=200 && $httpCode<500) ? $this->_address : false;
        return $return;

    }

    /**
     * Разрешена ли подгрузка в ифрейм
     * @return bool
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public  function isFrameAccept()
    {
        $client = new Client(['baseUrl' => $this->_address ]);
        $response = $client->createRequest()->send();
        if ($response->headers->get('x-frame-options')==null)
            return true;
        else
            return false;
    }


    /**
     * Сохранение скриншота сайта и обновления в проекте записи
     *
     * @return string - file Name
     */
    public function saveImgFile()
    {
        $rawHost = parse_url($this->_address);
        $host = array_key_exists('host', $rawHost) ? $rawHost['host'] : $rawHost['path'];
        $fileName = $host.'_1200x768.jpg';
        $filePath = Yii::getAlias('@screen_shot').$fileName;

        $fp = fopen ($filePath, 'w+');              // Create Image File
        if ($fp)
        {
            $url = Yii::$app->params['screenshots1200.url'].$host; // Get screenshots from screenshots
            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_FILE, $fp);          // Save  to file
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
            curl_exec($ch);  // Run getting
            curl_close($ch);                              // closing curl handle
            fclose($fp);
            return $fileName;
        }
        else
            return false;

    }


}