<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 26.11.2018
 * Time: 13:49
 */

namespace frontend\controllers;


use common\models\Channel;
use common\models\ChannelPosition;
use common\models\Domain;
use common\models\Position;
use common\models\WidgetFrame;
use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use common\models\Project;

class AjaxController extends Controller
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
                            'check-domain',
                        ],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                    [
                        'actions' => ['demo-site', 'visit-viewed', 'visit-phone', 'channel-add-new', 'widget-frame', 'widget-multi', 'save-val'],
                        'allow' => true,
                        'roles' => ['?', '@'], // Guest User
                    ],

                ],
            ],
        ];
    }

    /**
     * Добавляем новый канал
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionChannelAddNew($id)
    {
        if (Yii::$app->request->isAjax) {

            $project = $this->findModelProject($id);
            $channel = new Channel();
            $channel->project_id = $project->id;
            if ($channel->save())
                return Json::encode(['result'=> true, 'id' => $channel->id]);
            else
                return Json::encode(['result'=> false, 'error' => 10]);

        }
        return Json::encode(['result'=> false, 'error' => 404]);
    }

    /**
     * Проверям существование и валидность адреса
     * Коды ошибок. 10 - недоступен ресур, 20 - невалидный адрес ресурса
     * @return string
     */
    public function actionCheckDomain()
    {
        if (Yii::$app->request->isAjax) {
            $url = Yii::$app->getRequest()->getQueryParam('url');
            try {
                $domain = new Domain($url);
                $check = $domain->checkDomain();
                if ($check)
                {
                    // Проверка на ифрейм
                    if ($domain->isFrameAccept()) // iFrame разрешен
                    {
                        return Json::encode(['result'=> true, 'domain' => $check, 'screenShot' => 'frame' ]);
                    }
                    else // Запрещен, пытаемся сохранить изображение
                    {
                        $img = $domain->saveImgFile();
                        if ($img)
                            return Json::encode(['result'=> true, 'domain' => $check, 'screenShot' => $img ]);
                        else
                            return Json::encode(['result'=> true, 'domain' => $check, 'screenShot' => null ]);
                    }
                }
                else
                {
                    return Json::encode(['result'=> false, 'error' => 10]);
                }
            } catch (\Exception $exception)
            {
                return Json::encode(['result'=> false, 'error' => 20]);
            }

        }
    }

    /**
     * Статус виджета
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionWidgetFrame($id)
    {
        if (Yii::$app->request->isAjax) {
            $widget = $this->findModelWidgetFrame($id);
            $status = Yii::$app->getRequest()->getQueryParam('status');
            $result = '';
            if ($status!==null)
            {
                if ($status==1)
                {
                    $result = $widget->TurnOn();
                }
                else {
                    $result = $widget->TurnOff();

                }

            }
            return Json::encode(['result'=> $result]);

        }
    }

    /**
     * Сохраняем значение в матрицу позиций\каналов
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSaveVal()
    {
        if (Yii::$app->request->isAjax) {


            $channel = Channel::findOneByUser(intval(Yii::$app->getRequest()->getQueryParam('channel_id')));
            $position = Position::findOneByUser(intval(Yii::$app->getRequest()->getQueryParam('position_id')));
            $val = Yii::$app->getRequest()->getQueryParam('value');
            if ($channel&&$position&&($val!==null))
            {
                $channelPosition = ChannelPosition::findOne(['channel_id'=>$channel->id, 'position_id' => $position->id]);
                if ($channelPosition==null)
                {
                    $channelPosition = new ChannelPosition();
                    $channelPosition->channel_id = $channel->id;
                    $channelPosition->position_id = $position->id;
                }
                $channelPosition->val = $val;
                $channelPosition->save();
            }

            return Json::encode(['result'=> true]);

        }
        return Json::encode(['result'=> false]);
    }

    /**
     * Статус виджета Multi
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionWidgetMulti($id)
    {
        if (Yii::$app->request->isAjax) {
            $project = $this->findModelProject($id);
            $status = Yii::$app->getRequest()->getQueryParam('status');
            $result = '';
            if ($status!==null)
            {
                if ($status==1)
                {
                    $result = $project->wMultiTurnOn();
                }
                else {
                    $result = $project->wMultiTurnOff();

                }

            }
            return Json::encode(['result'=> $result]);

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

    /**
     * Find widget by primary key with condition, widget belong authorized user
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WidgetFrame the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelWidgetFrame($id)
    {
        if (($model = WidgetFrame::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Проект не найден.');
        }
    }

}