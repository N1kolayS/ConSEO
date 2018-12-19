<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WidgetFrame */

$this->title = 'Создать новый Виджет';
$this->params['breadcrumbs'][] = ['label' => 'Виджеты', 'url' => ['manage/widget-frame', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col m12 l6">
    <div class="card ui-app__page-content">
        <div class="card-content">

            <div class="card-title title"><?= Html::encode($this->title) ?></div>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>