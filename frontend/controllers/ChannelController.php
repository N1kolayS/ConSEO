<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 09.12.2018
 * Time: 13:37
 */


namespace frontend\controllers;


use common\models\Channel;
use common\models\Domain;
use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use common\models\Project;

/**
 * REST API interface
 * Class ChannelController
 * @package frontend\controllers
 */
class ChannelController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [

                    [
                        'actions' => [
                            'create',
                            'update',
                            'status'
                        ],
                        'allow' => true,
                        'roles' => ['user'],
                    ],


                ],
            ],
        ];
    }



    /**
     * Добавляем новый канал
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCreate()
    {
        if (Yii::$app->request->isAjax) {

            $project = $this->findModelProject( Yii::$app->getRequest()->getQueryParam('project_id'));
            $channel = new Channel();

            $channel->project_id = $project->id;
            if ($channel->save())
                return Json::encode(['result'=> true, 'id' => $channel->id]);
            else
                return Json::encode(['result'=> false, 'error' => 10]);

        }
    }

    /**
     * On/Off channel
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionStatus($id)
    {
        if (Yii::$app->request->isAjax) {

            $channel = $this->findModelChannel($id);
            $channel->enable = (Yii::$app->getRequest()->getQueryParam('status')=='enable') ? channel::STATUS_ENABLE : $channel::STATUS_DISABLE;
            if ($channel->save())
                return Json::encode(['result'=> true]);
            else
                return Json::encode(['result'=> false, 'error' => 10]);

        }
    }

    /**
     * On/Off channel
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->request->isAjax) {

            $channel = $this->findModelChannel($id);
            $params = Yii::$app->getRequest()->getQueryParam('attributes');
            $channel->setAttributes($params);
            if ($channel->save())
                return Json::encode(['result'=> true, 'params' => $params]);
            else
                return Json::encode(['result'=> false, 'error' => 10]);

        }
    }

    /**
     * Find project by primary key with condition, project belong authorized user
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Channel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelChannel($id)
    {
        if (($model = Channel::findOneByUser($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Json::encode(['result'=> false, 'error' => 50]));
        }
    }

    /**
     * Find project by primary key with condition, project belong authorized user
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelProject($id)
    {
        if (($model = Project::findOneByUser($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Проект не найден.');
        }
    }

}