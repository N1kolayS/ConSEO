<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use common\efnify\widgets\Nav;
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

                    <!-- //////////////////////////////////////////////////////// -->
                    <!-- navbar left side  -->
                    <div class="ui-app__wrapper__navbar__leftside--icons">

                        <!-- left sidenav toggle button(show and hide sidenav) -->
                        <div class="left ui-app__wrapper__navbar__leftside--icons__sidenav--toggle ui-app__wrapper__navbar__leftside--icon__item" data-target="ui-app__left-sidenav-slide-out" id="left-sidenav-toggle">
                            <i class="material-icons">menu</i>
                        </div>

                        <!-- Efnify app/brand title -->
                        <a href="dashboard.html" class="brand-logo ui-app__wrapper__navbar__leftside--icon__item"><img src="/theme/images/logo1.png" alt="conseo" > </a>

                        <!-- left sidenav toggle button(small and large sidenav) -->
                        <div class="ui-app__wrapper__navbar__leftside--icons__sidenav-small--toggle hide-on-med-and-down ui-app__wrapper__navbar__leftside--icon__item" id="left-sidenav-small-toggle">
                            <i class="material-icons">radio_button_checked</i>
                        </div>
                    </div>
                    <!-- End navbar left side  -->
                    <!-- ///////////////////////////////////////////////////////////////// -->

                    <!--Search box-->
                    <!-- ////////////////////////////////////////////////////////////// -->
                    <div class="ui-app__wrapper__navbar__leftside__search hide-on-med-and-down">
                        <!-- Search form -->
                        <form action="#">
                            <div class="input-field">
                                <!--Search input-->
                                <input id="search" type="search" autocomplete="off" placeholder="Search pages here!">
                                <!--End Search input-->
                                <!--Search icon-->
                                <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                                <!--End Search icon-->



                            </div>
                        </form>
                        <!-- End Search form -->
                    </div>
                    <!--End Search box-->
                    <!-- ////////////////////////////////////////////////////////////////// -->

                    <!-- ////////////////////////////////////////////////////////////////// -->
                    <!-- navbar right side  -->
                    <div class="ui-app__wrapper__navbar__rightside--icons right">
                        <!-- navbar menu list -->
                        <ul>

                            <!-- refresh/reload page button -->
                            <li class="ui-app__wrapper__navbar__rightside--icons__item hide-on-small-only" id="app-page-refresh"><i class="material-icons">refresh</i></li>

                            <!-- notification list -->
                            <li class="ui-app__wrapper__navbar__rightside--icons__item ui-app__wrapper__navbar__rightside--notifications notification-badge" data-target='dropdown-notifications-target' data-notifications="4"><i class="material-icons">notifications</i></li>

                            <!-- User profile -->
                            <li class="ui-app__wrapper__navbar__rightside--users ui-app__wrapper__navbar__rightside--icons__item" data-target="dropdown-user-profile-target">
                                M
                            </li>

                        </ul>


                        <!-- User profile dropdown structure -->
                        <div id="dropdown-user-profile-target" class="ui-app__wrapper__navbar__rightside--users__dropdown dropdown-content">
                            <ul>
                                <li><a href="#!"><i class="material-icons">perm_identity</i>My Profile</a></li>
                                <li><a href="javascript:void(0)" class="toggle-right-sidenav"><i class="material-icons">settings</i>Page Customizer</a></li>
                                <li class="divider"></li>
                                <li><a href="lock.html"><i class="material-icons">lock</i>Lock</a></li>
                                <li><a href="signup.html"><i class="material-icons">power_settings_new</i>Logout</a></li>
                            </ul>
                        </div>
                        <!-- End user profile dropdown structure -->
                        <!-- Notifications dropdown structure -->
                        <div id="dropdown-notifications-target" class="ui-app__wrapper__navbar__rightside--notifications__dropdown dropdown-content">
                            <ul class="collection">
                                <li class="collection-item avatar"> <img src="../assets/images/user1.jpg" alt="user profile picture" class="circle"> <span class="title">Brunch this weekend?</span>
                                    <p>Ali Connors <span class="body-1">&mdash; I'll be in your neighborhood doing errands this weekend.</span></p>
                                </li>
                                <li class="collection-item avatar"> <img src="../assets/images/user2.jpg" alt="user profile picture" class="circle"> <span class="title">Oui oui</span>
                                    <p>Sandra Adams <span class="body-1">&mdash; Do you have Paris recommendations? Have you ever been?</span></p>
                                </li>
                                <li class="collection-item avatar"> <img src="../assets/images/user3.jpg" alt="user profile picture" class="circle"> <span class="title">Birthday gift</span>
                                    <p>Trevor Hansen <span class="body-1">&mdash; Have any ideas about what we should get Heidi for her birthday?</span></p>
                                </li>
                                <li class="collection-item avatar"> <img src="../assets/images/user4.jpg" alt="user profile picture" class="circle"> <span class="title">Recipe to try</span>
                                    <p>Britta Holt <span class="body-1">&mdash; We should eat this: Grate, Squash, Corn, and tomatillo Tacos.</span></p>
                                </li>
                            </ul>
                        </div>
                        <!-- End notifications dropdown structure -->

                    </div>
                    <!-- End navbar left side  -->
                    <!-- ////////////////////////////////////////////////////////// -->
                </div>

            </nav>
        </div>
        <!--End navbar/header-->
        <!-- //////////////////////////////////////////////////////////////////// -->

        <!-- //////////////////////////////////////////////////////////////////////////// -->
        <!--Left sidenav/sidebar-->
        <aside class="ui-app__left-sidenav sidenav sidenav-fixed" id="ui-app__left-sidenav-slide-out">
            <!-- sidenav menu list -->
            <ul class="no-margin">
                <!-- dashboard menu -->
                <li>
                    <br />
                </li>
                <!--end  dashboard menu -->

                <!-- sidenav main menu list -->
                <li>
                    <?=Nav::widget([
                        'items' => [
                            [
                                'label' => '<i class="material-icons left">desktop_windows</i>Рабочий стол',
                                'url' => ['site/index'],

                            ],
                            [
                                'label' => '<i class="material-icons left">people</i>Пользователи',
                                'url' => ['site/users'],

                            ],
                            [
                                'label' => '<i class="material-icons left">collections_bookmark</i>Проекты',
                                'url' => ['project/index'],

                            ],
                            [
                                'label' => '<i class="material-icons left">library_books</i>Шаблоны',
                                'url' => ['template/index'],

                            ],
                            [
                                'label' => '<i class="material-icons left">build</i>Конфиги',
                                'items' => [
                                    ['label' => 'Предустановки', 'url' => ['config/index']],
                                    ['label' => 'Карты ссылок', 'url' => ['map-referral/index']],
                                ],
                            ],
                        ],
                        'options' => ['class' => 'ui-app__left-sidenav__menu collapsible collapsible-accordion ui-app__scrollbar']
                    ])?>
                </li>
                <!--end sidenav main menu list -->
            </ul>
            <!-- end sidenav menu list -->
        </aside>
        <!--End Left sidenav/sidebar-->
        <!-- //////////////////////////////////////////////////////////////////////////// -->

        <!--Page Body-->
        <main>
            <!-- Page heading -->
            <div class="card-body right-align">
                <?=Breadcrumbs::widget([
                        'tag' => 'ol',
                        'options' => ['class' => 'breadcrumbs'],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]);?>
            </div>
            <?= $content ?>
        </main>
        <!--End page body-->
        <footer class="page-footer">
            <div class="footer-copyright white grey-text">
                &copy; 2018 designlayout
            </div>
        </footer>
    </div>
    <?php $this->endBody() ?>
</div>
</body>
</html>
<?php $this->endPage() ?>
