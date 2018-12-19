<?php

namespace frontend\controllers;

use common\models\Project;
use Yii;
use common\models\WidgetFrame;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WidgetFrameController implements the CRUD actions for WidgetFrame model.
 */
class WidgetFrameController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * Creates a new WidgetFrame model, assigned to Project
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param int $id project_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCreate($id)
    {
        $project = $this->findModelProject($id);
        $model = new WidgetFrame();
        $model->project_id = $project->id;
        $this->view->params['project'] = $project;
        $model->enable = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['manage/widget-frame', 'id' => $model->project_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing WidgetFrame model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['manage/widget-frame', 'id' => $model->project_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing WidgetFrame model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WidgetFrame model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WidgetFrame the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WidgetFrame::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
