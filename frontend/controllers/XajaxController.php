<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 18.12.2018
 * Time: 14:54
 */

namespace frontend\controllers;

use common\models\Project;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use common\models\Visit;

class XajaxController extends Controller
{

    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        header("Access-Control-Allow-Headers: x-test-header, Origin, X-Requested-With, Content-Type, Accept, X-Custom-Header, Content-length");
        header("Access-Control-Expose-Headers: Content-Length, X-Kuma-Revision");

        return parent::beforeAction($action);
    }

    /**
     * Record visits
     * @param $id - project_id
     * @return string
     */
    public function actionVisit($id)
    {
        if (Yii::$app->request->isAjax) {
            if (($project =  Project::findOne($id) !== null))
            {
                $visit = Visit::saveVisit($id,
                    Yii::$app->getRequest()->post('channel_id'),
                    Yii::$app->getRequest()->post('cookie'),
                    Yii::$app->getRequest()->post('url'),
                    Yii::$app->getRequest()->post('ref'),
                    Yii::$app->getRequest()->post('ip'),
                    Yii::$app->getRequest()->post('browser'),
                    Yii::$app->getRequest()->post('mobile'));
                return (Json::encode(['result'=> true, 'cookie'=> $visit->cookie ]));
            }
            return (Json::encode(['result'=> false, 'err'=>'Bad key']));
        }
    }

}