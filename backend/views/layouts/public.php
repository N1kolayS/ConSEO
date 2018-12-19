<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 28.11.2018
 * Time: 22:55
 */

/* @var $this \yii\web\View */
/* @var $content string */

/**
 * ----------------------
 * Шаблон для не авторизованных пользоваталей
 */

use yii\helpers\Html;
use frontend\assets\AppAsset;

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
        <div class="ui-app__wrapper left-sidenav-close">

            <!--prepage loader-->
            <div id="prepage-loader">
                <div class="ui-app__prepage-loader spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
            <!-- End prepage loader-->

            <!--navbar/header-->
            <nav class="ui-app__wrapper__navbar-form">
                <div class="nav-wrapper">
                    <a href="/" class="form-brand-logo"><img src="/theme/images/brand-logo.png" alt="conseo" class="nav-public-logo" ></a>
                    <ul class="right">
                        <?=Html::a('Войти', ['site/login'], ['class' => 'waves-effect waves-light btn btn-rounded btn-depressed ui-app__wrapper__navbar-form__signup'])?>
                    </ul>
                </div>
            </nav>
            <!--End navbar/header-->

            <!--Page Body-->
            <main>
                <!-- Page content -->
                <div class="row">
                    <!-- Page content body -->
                    <div class="col s12">
                        <div class="card ui-app__page-content ui-app__page-content--form">
                            <?= $content ?>
                        </div>
                    </div>
                    <!-- End Page content body -->
                </div>
                <!--End Page content -->
            </main>
            <!--End page body-->

            <!--Footer-->
            <footer class="page-footer page-footer-form">
                <ul class="center-align">
                    <li>Используя сервис, вы соглашаетесь с условиями  <a href="#">лицензионного соглашения.</a></li>
                    <li>ООО «Бизнес интуиция» 2018 г.</li>
                </ul>
            </footer>
            <!--End footer-->

        </div>
        <!-- End Efnify body page wrapper -->
        <?php $this->endBody() ?>
    </div>
    </body>
    </html>
<?php $this->endPage() ?>