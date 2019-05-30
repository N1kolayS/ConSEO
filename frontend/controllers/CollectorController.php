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

class CollectorController extends Controller
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
                $request = Yii::$app->getRequest();
                $visit = Visit::saveVisit($id,
                    $request->post('channel_id'),
                    $request->post('cookie'),
                    $request->post('url'),
                    $request->post('ref'),
                    $request->post('ip'),
                    $request->post('browser'),
                    $request->post('mobile'));
                return (Json::encode(['result'=> true, 'cookie'=> $visit->cookie ]));
            }
            return (Json::encode(['result'=> false, 'err'=>'Bad key']));
        }
    }

    /**
     * Record visits
     * @param $id - project_id
     *
     */
    public function actionBeacon($id)
    {

        $request = Yii::$app->getRequest();
        $visit = Visit::saveVisit($id,
            $request->post('channel_id'),
            $request->post('cookie'),
            $request->post('url'),
            $request->post('ref'),
            $request->post('ip'),
            $request->post('browser'),
            $request->post('mobile'));

    }

    /**
     * Record view
     * @param $id - $visit_id
     * @return string
     */
    public function actionFrame($id)
    {

        if (Yii::$app->request->isAjax) {
            if (($visit =  Visit::findOne($id)) !== null)
            {
                $request = Yii::$app->getRequest();
                if ($request->getQueryParam('viewed'))
                {
                    $visit->updateCounters(['viewed' =>1]);
                }
                if ($request->getQueryParam('used'))
                {
                    $visit->updateCounters(['used' =>1]);
                }

                return (Json::encode(['result'=> true]));
            }
            return (Json::encode(['result'=> false, 'err'=>'Bad key']));
        }

    }

}