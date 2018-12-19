<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 28.11.2018
 * Time: 21:30
 */

use yii\helpers\Html;

use common\efnify\widgets\Nav;
/* @var $model common\models\Project */

$menu = [
    [
        'label' => '<i class="material-icons left">dashboard</i>Рабочий стол',
        'url' => ['manage/dash', 'id' => $model->id],

    ],
    [
        'label' => '<i class="material-icons left">reorder</i>Каналы',
        'url' => ['manage/channels', 'id' => $model->id],

    ],
    [
        'label' => '<i class="material-icons left">desktop_windows</i>Виджет',
        'items' => [
            ['label' => 'Фрейм', 'url' => ['manage/widget-frame', 'id' => $model->id]],
            ['label' => 'Мульти', 'url' => ['manage/widget-inline', 'id' => $model->id]],
        ],
    ],

    [
        'label' => '<i class="material-icons left">build</i>Настройки',
        'url' => ['manage/config', 'id' => $model->id],

    ],


];

$submenu = [
    [
        'label' => '<i class="material-icons">help</i>Быстрый старт',
        'url' => ['manage/start', 'id' => $model->id],
    ],
    [
        'label' => '<i class="material-icons">phone</i>Позвоните нам',
        'url' => ['!#'],
    ],
    [
        'label' => '<i class="material-icons">email</i>Свяжитесь с нами',
        'url' => ['!#'],
    ],



];
?>

<ul class="no-margin">
    <li>
        <?=Html::a('<i class="material-icons left">dashboard</i>'. $model->name, ['manage/dash', 'id' => $model->id], ['class' => 'waves-effect waves-light btn btn-rounded btn-dashboard']) ?>
    </li>

    <!-- sidenav main menu list -->
    <li><?=Nav::widget([
            'items' => $menu,
            'options' => ['class' => 'ui-app__left-sidenav__menu collapsible collapsible-accordion ui-app__scrollbar']
        ])?>

    </li>
    <!--end sidenav main menu list -->

    <!-- sidenav quick/sub main menu list -->
    <li class="ui-app__left-sidenav__collapsible-quick-menu-name">
        Помощь
    </li>
    <li>
        <?=Nav::widget([
            'items' => $submenu,
            'options' => ['class' => 'ui-app__left-sidenav__collapsible-quick-menu ui-app__scrollbar']
        ])?>

    </li>
    <!-- end sidenav quick/sub main menu list -->
</ul>
