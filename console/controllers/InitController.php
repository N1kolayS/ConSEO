<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 20.11.2018
 * Time: 22:00
 */

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;

class InitController extends Controller
{
    /**
     * @throws \yii\base\Exception
     * @throws \Exception
     */
    public function actionRbac()
    {
        // First Run yii migrate --migrationPath=@yii/rbac/migrations/
        $role = Yii::$app->authManager->createRole('admin');
        $role->description = 'Администратор';
        Yii::$app->authManager->add($role);

        $role = Yii::$app->authManager->createRole('manager');
        $role->description = 'Менеджер';
        Yii::$app->authManager->add($role);

        $role = Yii::$app->authManager->createRole('agent');
        $role->description = 'Расширенный';
        Yii::$app->authManager->add($role);

        $role = Yii::$app->authManager->createRole('user');
        $role->description = 'Пользователь';
        Yii::$app->authManager->add($role);

        // Implement
        $role_admin = Yii::$app->authManager->getRole('admin');
        $role_manager = Yii::$app->authManager->getRole('manager');
        $role_agency = Yii::$app->authManager->getRole('agent');
        $role_user = Yii::$app->authManager->getRole('user');
        Yii::$app->authManager->addChild($role_admin, $role_manager);
        Yii::$app->authManager->addChild($role_manager, $role_agency);
        Yii::$app->authManager->addChild($role_agency, $role_user);
        /* */
    }

    /**
     * @param $username
     * @param $password
     * @param $email
     * @throws \Exception
     */
    public function actionUserCreate($username, $password, $email)
    {
        if (Yii::$app->authManager->getRole(User::ROLE_DEFAULT))
        {
            $user = new User();
            $user->username = $username;
            $user->email = $email;

            $user->setPassword($password);
            $user->generateAuthKey();
            $user->role = User::ROLE_ADMIN;



            if ($user->save()) {
                Yii::$app->authManager->revokeAll($user->id);
                $userRole = Yii::$app->authManager->getRole(User::ROLE_ADMIN);
                Yii::$app->authManager->assign($userRole, $user->id);
                $user->updateAll(['role' => User::ROLE_ADMIN], $user->id);
                echo $user->username. PHP_EOL;

            }
            else
            {
                echo var_dump($user->errors);
            }
        }
        else
        {
            echo 'Roles not assigned, run init/rbac '.PHP_EOL;
        }


    }
}