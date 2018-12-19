<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 25.11.2018
 * Time: 23:07
 */


/* @var $this \yii\web\View */
/* @var $content string */

/**
 * ----------------------
 * Шаблон для выбора проекта
 */

use yii\helpers\Html;


use frontend\assets\AppAsset;
use yii\helpers\StringHelper;
use yii\widgets\Breadcrumbs;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>


    <link rel="apple-touch-icon"      sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">


    <?php $this->head() ?>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="ui-app">
    <?php $this->beginBody() ?>
        <!--Efnify body page wrapper -->
        <div class="ui-app__wrapper left-sidenav-close" id="app-layout-control">
            <!--prepage loader-->
            <div id="prepage-loader">
                <div class="ui-app__prepage-loader spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
            <!-- End prepage loader-->
            <!--navbar/header-->
            <div class="navbar-fixed">
                <nav class="ui-app__wrapper__navbar">
                    <div class="nav-wrapper">

                        <!-- //////////////////////////////////////////////////////// -->
                        <!-- navbar left side  -->
                        <div class="ui-app__wrapper__navbar__leftside--icons">
                            <?=Html::a('<img src="/theme/images/logo1.png" alt="conseo" >', ['site/index'], ['class' => 'brand-logo ui-app__wrapper__navbar__leftside--icon__item'])?>
                        </div>
                        <!-- End navbar left side  -->
                        <!-- ///////////////////////////////////////////////////////////////// -->

                        <div class="ui-app__wrapper__navbar__rightside--icons right">
                            <!-- navbar menu list -->
                            <ul>
                                <!-- refresh/reload page button -->
                                <li class="ui-app__wrapper__navbar__rightside--icons__item hide-on-small-only" id="app-page-refresh"><i class="material-icons">refresh</i></li>
                                <!-- User profile -->
                                <li class="ui-app__wrapper__navbar__rightside--users ui-app__wrapper__navbar__rightside--icons__item" data-target="dropdown-user-profile-target">
                                    <?=StringHelper::truncate(Yii::$app->user->identity->username,1, '')?>
                                </li>
                            </ul>

                            <!-- User profile dropdown structure -->
                            <div id="dropdown-user-profile-target" class="ui-app__wrapper__navbar__rightside--users__dropdown dropdown-content">
                                <ul>
                                    <li><?=Html::a('<i class="material-icons">perm_identity</i>Мой профиль', ['/user/cabinet'])?></li>
                                    <li class="divider"></li>
                                    <li><?=Html::a('<i class="material-icons">power_settings_new</i>Выйти', ['/site/logout'], ['data-method' => 'post'])?></li>
                                </ul>
                            </div>
                            <!-- End user profile dropdown structure -->
                        </div>

                        <!-- ////////////////////////////////////////////////////////// -->
                    </div>

                </nav>
            </div>
            <!--End navbar/header-->

            <!--Page Body-->
            <main>
                <div class="card-body right-align">
                    <?= Breadcrumbs::widget([
                            'homeLink' => [
                                'label' => 'Мои проекты',
                                'url' => ['site/index']
                            ],
                            'tag' => 'ol',
                            'options' => ['class' => 'breadcrumbs'],
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                </div>
                <div class="row">
                    <!-- Page content body -->
                    <?= $content ?>
                    <!-- End Page content body -->
                </div>
            </main>
            <!--End page body-->

            <footer class="page-footer">
                <ul class="center-align">
                    <li>Используя сервис, вы соглашаетесь с условиями  <a href="#">лицензионного соглашения.</a></li>
                    <li>ООО «Бизнес интуиция» 2018 г.</li>
                </ul>
            </footer>
        </div>
    <?php $this->endBody() ?>
    </div>
</body>
</html>
<?php $this->endPage() ?>
