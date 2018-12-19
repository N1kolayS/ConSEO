<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\StringHelper;


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


    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
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
    <!--Efnify body-->
    <div class="ui-app">

    <?php $this->beginBody() ?>
        <!--Efnify body page wrapper -->
        <div class="ui-app__wrapper" id="app-layout-control">
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

                        <!-- navbar left side  -->
                        <div class="ui-app__wrapper__navbar__leftside--icons">

                            <!-- left sidenav toggle button(show and hide sidenav) -->
                            <div class="left ui-app__wrapper__navbar__leftside--icons__sidenav--toggle ui-app__wrapper__navbar__leftside--icon__item" data-target="ui-app__left-sidenav-slide-out" id="left-sidenav-toggle">
                                <i class="material-icons">menu</i>
                            </div>

                            <!-- Logo -->
                            <?=Html::a('<img src="/theme/images/logo1.png" alt="conseo" >', ['site/index'], ['class' => 'brand-logo ui-app__wrapper__navbar__leftside--icon__item'])?>

                            <!-- left sidenav toggle button(small and large sidenav) -->
                            <div class="ui-app__wrapper__navbar__leftside--icons__sidenav-small--toggle hide-on-med-and-down ui-app__wrapper__navbar__leftside--icon__item" id="left-sidenav-small-toggle">
                                <i class="material-icons">radio_button_checked</i>
                            </div>
                        </div>
                        <!-- End navbar left side  -->

                        <!--Search box-->
                        <!-- ////////////////////////////////////////////////////////////// -->
                        <div class="ui-app__wrapper__navbar__leftside__search hide-on-med-and-down">
                            <!-- Search form -->
                            <form action="#">
                                <div class="input-field">
                                    <!--Search input-->
                                    <input id="search" type="search" autocomplete="off" placeholder="Поиск по разделам">
                                    <!--End Search input-->
                                    <!--Search icon-->
                                    <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                                    <!--End Search icon-->

                                </div>
                            </form>
                            <!-- End Search form -->
                        </div>
                        <!--End Search box-->

                        <!-- navbar right side  -->
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
                        <!-- End navbar left side  -->
                    </div>

                </nav>
            </div>
            <!--End navbar/header-->

            <!--Left sidenav/sidebar-->
            <aside class="ui-app__left-sidenav sidenav sidenav-fixed" id="ui-app__left-sidenav-slide-out">

                <?=\app\widgets\LeftMenu::widget([
                        'model' => array_key_exists('project', $this->params) ? $this->params['project'] : null

                ])?>
            </aside>
            <!--End Left sidenav/sidebar-->

            <!--Page Body-->
            <main>
                <div class="card-body right-align">
                <?php
                if (array_key_exists('project', $this->params)) {
                    $project =  $this->params['project'];
                    echo Breadcrumbs::widget([
                        'homeLink' => [
                            'label' => 'Рабочий стол',
                            'url' => ['manage/dash', 'id'=> $project->id ]
                        ],
                        'tag' => 'ol',
                        'options' => ['class' => 'breadcrumbs'],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]);
                }
                ?>
                </div>
                <?= Alert::widget() ?>
                <?= $content ?>
            </main>
            <!--End page body-->
            <footer class="page-footer">
                <div class="footer-copyright white grey-text">
                    &copy; 2018 ООО Бизнес Интуиция
                </div>
            </footer>
        </div>
    <?php $this->endBody() ?>
    </div>
</body>
</html>
<?php $this->endPage() ?>
