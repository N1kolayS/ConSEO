<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 19.12.2018
 * Time: 10:18
 */

/* @var $this yii\web\View */
/* @var $model \common\models\User */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Мой кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="col s12">
    <div class="card ui-app__page-content">

        <div class="card-content">
            <div class="card-title headline"><?= Html::encode($this->title) ?></div>
            <div class="card-body">
                <h3>Добро пожаловать <?=$model->username?></h3>


            </div>
        </div>
    </div>


</div>