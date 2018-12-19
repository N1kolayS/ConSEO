<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 04.12.2018
 * Time: 22:14
 */

namespace frontend\controllers;

use common\models\Project;
use Yii;

use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;


class FileController extends Controller
{
    /**
     * Loader script
     * @param $id
     * @return string
     * @throws string
     */
    public function actionScript($id)
    {

        $response = Yii::$app->response;
        $response->format = Response::FORMAT_RAW;
        $response->getHeaders()->set('Content-Type', 'application/javascript');

        $this->layout = 'clear';
        $model = $this->findModel($id);
        $widget = $model->findDefaultWidget();

        if ($model->isEnabled()&&$widget)
        {
            $widget->mobile = (\Yii::$app->devicedetect->isMobile())&&(!\Yii::$app->devicedetect->isTablet());
            return $this->render( 'script', [
                'model' => $this->findModel($id),
                'ip' => Yii::$app->request->userIP,
                'lifetime' => '3600',
                'widget' => $widget,
            ]);
        }
        else
            return $this->render('disable');
    }

    /**
     * Demo script
     * @param $id
     * @return string
     * @throws string
     */
    public function actionDemo($id)
    {

        $response = Yii::$app->response;
        $response->format = Response::FORMAT_RAW;
        $response->getHeaders()->set('Content-Type', 'application/javascript');
        $this->layout = 'clear';
        $model = $this->findModel($id);
        $widget = $model->findDefaultWidget();

        if ($model->isEnabled()&&$widget)
        {
            $widget->mobile = (\Yii::$app->devicedetect->isMobile())&&(!\Yii::$app->devicedetect->isTablet());
            return $this->render( 'demo', [
                'model' => $model,
                'widget' => $widget,
            ]);
        }
        else
            return $this->render('disable');
    }

    /**
     * Finds the Demo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Widget not exist.');
        }
    }
}