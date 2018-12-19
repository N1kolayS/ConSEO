<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 19.12.2018
 * Time: 10:22
 */

namespace frontend\controllers;

use common\models\User;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class UserController extends Controller
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
                        'actions' => ['cabinet', 'change-password', 'change-email'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }

    /**
     * User cabinet
     *
     * @return mixed
     */
    public function actionCabinet()
    {
        $this->layout = 'start';
        $model = User::findOne(Yii::$app->user->id);
        return $this->render('cabinet', [
            'model' => $model,
        ]);
    }
}