<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 28.11.2018
 * Time: 21:10
 */

namespace frontend\controllers;

use common\models\MapReferral;
use common\models\Position;
use common\models\Project;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;


class ManageController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['dash', 'statistic', 'widget-frame', 'widget-multi', 'config', 'channels', 'start', 'start-test'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }

    /**
     * DashBoard
     * @param $id
     * @return mixed
     * @throws
     */
    public function actionDash($id)
    {

        $project = $this->findModelProject($id);
        $this->view->params['project'] = $project;
        return $this->render('dash', [
            'project' => $project
        ]);
    }

    /**
     * Statistic page
     * @param $id
     * @return mixed
     * @throws
     */
    public function actionStatistic($id)
    {

        $project = $this->findModelProject($id);
        $this->view->params['project'] = $project;
        return $this->render('dash', [
            'project' => $project
        ]);
    }

    /**
     * WidgetFrame
     * @param $id
     * @return mixed
     * @throws
     */
    public function actionWidgetFrame($id)
    {
        $project = $this->findModelProject($id);
        $this->view->params['project'] = $project;
        $widget = $project->findDefaultWidget();

        if ($widget->load(Yii::$app->request->post()) && $widget->save()) {
            return $this->refresh();
        }


        return $this->render('widget-frame', [
            'project' => $project,
            'widget' => $widget
        ]);
    }

    /**
     * Widget Multi. MultiLanding
     * @param $id
     * @return mixed
     * @throws
     */
    public function actionWidgetMulti($id)
    {
        $project = $this->findModelProject($id);
        $this->view->params['project'] = $project;
        $position = new Position();
        $position->project_id = $id;

        if ($position->load(Yii::$app->request->post()) && $position->save()) {
            return $this->refresh();
        }

        return $this->render('widget-multi', [
            'project' => $project,
            'position' => $position
        ]);
    }

    /**
     * Channels
     * @param $id
     * @return mixed
     * @throws
     */
    public function actionChannels($id)
    {
        $project = $this->findModelProject($id);
        $mapReferral = new MapReferral();
        $this->view->params['project'] = $project;
        return $this->render('channels', [
            'project' => $project,
            'mapReferral' => $mapReferral
        ]);
    }

    /**
     * Config
     * @param $id
     * @return mixed
     * @throws
     */
    public function actionConfig($id)
    {
        $project = $this->findModelProject($id);
        $this->view->params['project'] = $project;
        return $this->render('config', [
            'project' => $project
        ]);
    }

    /**
     * Quick Start
     * @param $id
     * @return mixed
     * @throws
     */
    public function actionStart($id)
    {
        $project = $this->findModelProject($id);
        $this->view->params['project'] = $project;
        return $this->render('start', [
            'project' => $project
        ]);
    }

    /**
     * Quick Start
     * @param $id
     * @return mixed
     * @throws
     */
    public function actionStartTest($id)
    {
        $this->layout = 'frame';
        $project = $this->findModelProject($id);
        $this->view->params['project'] = $project;
        return $this->render('start', [
            'project' => $project
        ]);
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