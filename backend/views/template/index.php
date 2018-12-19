<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Шаблоны';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row ui-app__row">
    <div class="col s12 ui-app__header">
        <h1 class="ui-app__header__title display-1"><?= Html::encode($this->title) ?></h1>

        <p class="right-align">
            <?= Html::a('Создать шаблон', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

    </div>
</div>
<div class="row">
    <div class="col s12">
        <div class="card ui-app__page-content">
            <div class="card-content">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        'name',
                        'file',
                        //'enable',

                        ['class' => 'common\efnify\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
